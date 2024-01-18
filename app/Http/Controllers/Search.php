<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Contracts\View\View;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

/**
 * Summary of Search
 * @author Developer
 * @copyright (c) 2024
 */
class Search extends Controller
{
    public const VALUESERP_API_KEY = 'AB24CF8E725F4553B3B08BC9D5092A27';
    /**
     * Summary of records
     * @var 
     */
    public $records;
    /**
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index(Request $request): View
    {
        if ($request->has('q')) {
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://api.valueserp.com/search', [
                    'api_key' => self::VALUESERP_API_KEY,
                    'q' => $request->get('q'),
                    'location' => $request->get('location'),
                    'hl' => $request->get('hl'),
                    'google_domain' => $request->get('google_domain'),
                    'gl' => $request->get('gl'),
                    'page' => $request->get('page') ?? 1,
                    'num' => 10

                ]);
                $response->throw();
                $this->records = $response->json();
            } catch (\Exception $e) {
                Log::info("Error: " . $e->getMessage());
            }
        }
        $current_page = $request->get('page') ?? 1;
        $data = [
            'items' => $this->records['organic_results'] ?? [],
            'total_items' => $this->records['search_information']['total_results'] ?? 0,
            'page' => $request->get('page') ?? 1,
            'query' => $request,
            'prev' => $this->withCustomQuery($current_page > 1 ? ($current_page - 1) : 1),
            'next' => $this->withCustomQuery($current_page + 1)
        ];
        return view('dashboard')->with($data);
    }
    /**
     * Summary of getCVEFile
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function getCVEFile(Request $request)
    {
        if ($request->has('q')) {
            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->get('https://api.valueserp.com/search', [
                    'api_key' => self::VALUESERP_API_KEY,
                    'q' => $request->get('q'),
                    'location' => $request->get('location'),
                    'hl' => $request->get('hl'),
                    'google_domain' => $request->get('google_domain'),
                    'gl' => $request->get('gl'),
                    'page' => $request->get('page') ?? 1,
                    'num' => 10

                ]);
                $response->throw();
                $this->records = $response->json();
            } catch (\Exception $e) {
                Log::info("Error: " . $e->getMessage());
            }
        }
        $headers = array(
            'Content-Type' => 'text/csv'
        );
        if (!File::exists(public_path() . "/files")) {
            File::makeDirectory(public_path() . "/files");
        }
        $filename =  public_path("files/download.csv");
        $handle = fopen($filename, 'w');
        //adding the first row
        fputcsv($handle, [
            "Title",
            "Domain",
            "Snippet",
            "Link"
        ]);
        $items = $this->records['organic_results'] ?? [];
        //adding the data from the array
        foreach ($items as $item) {
            fputcsv($handle, [
                $item['title'] ?? '',
                $item['domain'] ?? '',
                $item['snippet'] ?? '',
                $item['link'] ?? '',
            ]);
        }
        fclose($handle);

        //download command
        return Response::download($filename, "download.csv", $headers);
    }

    /**
     * Summary of withCustomQuery
     * @param mixed $page
     * @return string
     */
    public function withCustomQuery($page)
    {
        $currentUrl = url()->current();
        $currentQueryParams = request()->query();
        $currentQueryParams['page'] = $page;
        // Generate the updated URL
        return url()->to($currentUrl . '?' . http_build_query($currentQueryParams));
    }
}
