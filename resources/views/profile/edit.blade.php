@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                    <h4 class="my-2">{{ __('Modify Profile') }}</h4>               
                <div class="py-4">
                    <form method="POST" action="{{  route('profile.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                       
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                            <div class="col-md-6">
                                <!--<input id="avatar" type="text" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ $user->avatar }}" required >-->
                                <select class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" required>
                                <option value ="bulbasaur">{{__('bulbasaur')  }}</option>
                                <option value="charmander">{{__('charmander')  }}</option>
                                <option value="jigglypuff" >{{__('jigglypuff')  }}</option>
                                <option value="pikachu">{{__('pikachu')  }}</option>
                                <option value="pokeball" >{{__('pokeball')  }}</option>
                                <option value="squirtle">{{__('squirtle')  }}</option>
                            </select>

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
