@extends('layout.app')
@section('title','Admin Dashbaord')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Search Results</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form class="row" id="search-form" action="" method="GET">
                                <div class="col-md-2">
                                    <label for="hl">Locations</label>
                                    <select class="form-control" name="location">
                                        <option value="">Select Location</option>
                                        @foreach(locationList() as $location)
                                        <option value="{{ $location }}" @selected($location==$query->get('location'))>{{ $location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="hl">Google UI Language</label>
                                    <select class="form-control" name="hl">
                                        <option value="">Select Language</option>
                                        @foreach(getLangaugesDomainAndCountries() as $language)
                                        <option value="{{ $language['code'] ?? '' }}" @selected($language['code']==$query->get('hl'))>{{ $language['name'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="google_domain">Google Domain</label>
                                    <select class="form-control" id="google_domain" name="google_domain">
                                        <option value="">Select Domain</option>
                                        @foreach(getLangaugesDomainAndCountries() as $domain)
                                        <option value="{{ $domain['google_domain'] ?? '' }}" @selected($domain['google_domain']==$query->get('google_domain'))>{{ $domain['google_domain'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('google_domain')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="gl">Google Country</label>
                                    <select class="form-control" id="gl" name="gl">
                                        <option value="">Select Country</option>
                                        @foreach(getLangaugesDomainAndCountries() as $country)
                                        <option value="{{ $country['country_code'] ?? '' }}" @selected($country['country_code']==$query->get('gl'))>{{ $country['country'] ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    @error('gl')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label for="">Search</label>
                                    <input type="text" name="q" placeholder="Search" value="{{$query->get('q')}}">
                                    @error('q')
                                    <div style="color:red">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-2">
                                    <button type="submit" class="btn btn-info mt-3">Filter</button>
                                </div>
                            </form>

                            <hr class="">
                        </div>

                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Domain</th>
                                    <th scope="col">Snippet</th>
                                    <th scope="col">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                <tr>
                                    <td>{{ $item['title'] ?? '' }}</td>
                                    <td>{{ $item['domain'] ?? '' }}</td>
                                    <td>{{ $item['snippet'] ?? '' }}</td>
                                    <td><a href="{{ $item['link'] ?? '' }}" class="btn btn-info">Visit</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No Records Found..</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="pagination">
                                <span class="page-item" style="float:left">
                                    <a href="{{$prev}}" class="page-link btn btn-default">Previous</a>
                                </span>
                                <span class="page-item" style="float: right;">
                                    <a class="page-link btn btn-default" href="{{ $next}}">Next</a>
                                </span>
                            </div>
                        </div>
                        @if(!empty($items))
                        <a href="{{ route('download',http_build_query(request()->query())) }}" class="btn btn-success">Export</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search-form").validate({
            onkeyup: false,
            rules: {
                location: {
                    required: true
                },

                hl: {
                    required: true
                },
                google_domain: {
                    required: true
                },
                gl: {
                    required: true
                },
                q: {
                    required: true,
                    minlength: 2
                },
                messages: {
                    location: "Location is required",
                    hl: "Language is required",
                    google_domain: "Domain is required",
                    gl: "Country is required",
                    q: "Keyword is required"
                },
                submitHandler: function(form) {
                    return false;
                }
            }
        });
    });
</script>
@endpush