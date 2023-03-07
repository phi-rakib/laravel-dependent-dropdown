@extends('layout')

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Laravel Dependent Dropdown Example</h2>
                </div>
        
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <select name="" id="country-dropdown" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="state-dropdown" id="state-dropdown" class="form-control"></select>
                        </div>

                        <div class="form-group">
                            <select name="city-dropdown" id="city-dropdown" class="form-control"></select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#country-dropdown').on('change', function() {
                var idCountry = this.value;
                
                $.ajax({
                    url: `{{ route('state.post') }}`,
                    type: 'POST',
                    data: {
                        country_id: idCountry,
                        _token: `{{ csrf_token() }}`
                    },
                    dataType:'json',
                    success: function(result) {
                        $('#state-dropdown').html('<option value="">Select State</option>');
                        $.each(result, function(key, value) {
                            $('#state-dropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">Select City</option>');
                    }
                });
            });

            $('#state-dropdown').on('change', function() {
                var idState = this.value;
                
                $.ajax({
                    url: `{{ route('city.post') }}`,
                    type: 'POST',
                    data: {
                        state_id: idState,
                        _token: `{{ csrf_token() }}`
                    },
                    dataType:'json',
                    success: function(result) {
                        console.log(result);
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result, function(key, value) {
                            $('#city-dropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection