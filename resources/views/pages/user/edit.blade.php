@extends('layouts.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('content')

<div id="colorlib-main">
    <section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container mt-5">
        <div class="mb-4">
            <h4>Create User</h4>
        </div>
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" value="{{ old('name')??$user->name }}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter user full name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">E-mail Address</label>
                        <input type="text" name="email" value="{{ old('email')??$user->email }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter user email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="name">Role</label>
                        <select name="role" id="role" onchange="checkRole(this)" class="form-control @error('role') is-invalid @enderror">
                            <option disabled selected>Choose user role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role')?(old('role') == ($role->name)?'selected':''):($user->getRoleNames()->first() == $role->name? 'selected':'') }}>{{ title_case($role->name) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="form-group" id="area" style="display: none;">
                        <label for="name">Responsible Area</label>
                        <select name="area" class="form-control @error('area') is-invalid @enderror">
                            <option disabled selected>Choose responsible area</option>
                            @foreach ($persons as $person)
                                <option value="{{ $person->id }}" {{ old('area')?(old('area') == ($person->id)?'selected':''):($user->area == $person->id? 'selected':'') }}>{{ $person->proper_name }}</option>
                            @endforeach
                        </select>
                        @error('area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
    </section>
</div>
    
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        var el = {value:@json(old('role')??($user->getRoleNames()->first()))};
        checkRole(el);
    });
    
    function checkRole(el) {
        var area = $('#area');
        if (el.value == 'staff') {
            console.log('1');
            area.fadeIn('2');
        } else {
            console.log('2');
            area.fadeOut('1');
        }
    }

</script>
@endsection