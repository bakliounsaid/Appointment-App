<main class="d-flex w-100 h-100">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">{{ __('Reset password') }}</h1>
                        <p class="lead">
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form wire:submit.prevent="resetPassword">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">{{ __('Email') }}</label>
                                        <input class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            wire:model="email" type="email" name="email"
                                            placeholder="{{ __('Enter your email') }}" autocomplete="off" id="email"
                                            readonly disabled>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">{{ __('New password') }}</label>
                                        <div class="input-group" x-data="{ show: false }">
                                            <input
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                x-bind:type="!show ? 'password' : 'text'"
                                                placeholder="{{ __('Enter your new password') }}" wire:model="password"
                                                autocomplete="new-password" id="password" />
                                            <span class="input-group-text" x-on:click="show = !show">
                                                <i x-show="!show" class="align-middle" data-feather="eye"></i>
                                                <i x-show="show" class="align-middle" data-feather="eye-off"></i>
                                            </span>

                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="password-confirmation">{{ __('New password confirmation') }}</label>
                                        <div class="input-group" x-data="{ show: false }">
                                            <input
                                                class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
                                                x-bind:type="!show ? 'password' : 'text'"
                                                placeholder="{{ __('Enter your new password confirmation') }}"
                                                wire:model="password_confirmation"
                                                autocomplete="new-password-confirmation" id="password-confirmation" />
                                            <span class="input-group-text" x-on:click="show = !show">
                                                <i x-show="!show" class="align-middle" data-feather="eye"></i>
                                                <i x-show="show" class="align-middle" data-feather="eye-off"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @if ($status != '')
                                        <div class="@error('status') text-danger @else text-success @enderror">
                                            {{ __($status) }}
                                        </div>
                                    @endif

                                    <div class="d-grid gap-2 mt-3">
                                        <button class="btn btn-lg btn-primary" type="submit">
                                            {{ __('Reset password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        {{ __('Remembered your password?') }} <a href="{{ route('agency.auth.login') }}"
                            wire:navigate>
                            {{ __('Sign in') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
