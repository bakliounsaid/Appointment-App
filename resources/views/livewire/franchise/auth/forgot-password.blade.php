<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">{{ __('Forgot password?') }}</h1>
                        <p class="lead">
                            {{ __('Enter the email address associated with your account and we will send you a link to reset your password.') }}
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form wire:submit.prevent="sendRestLink">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">{{ __('Email') }}</label>
                                        <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            wire:model="email" type="email" name="email"
                                            placeholder="{{ __('Enter your email') }}" autocomplete="off"
                                            id="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    @if ($status != '')
                                        <div class="@error('status') text-danger @else text-success @enderror">
                                            {{ __($status) }}
                                        </div>
                                    @endif

                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-lg btn-primary" type="submit">
                                            {{ __('Request Password Reset') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        {{ __('Remembered your password?') }} <a href="{{ route('franchise.auth.login') }}" wire:navigate>
                            {{ __('Sign in') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
