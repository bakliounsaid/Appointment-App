<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="text-center mt-4">

                        <p class="lead">
                            {{ __('Sign in to your account to continue') }}
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('assets/img/photos/logo.jpg') }}" alt="Logo" style="max-width: 70px;">
                                </div>
                                <form wire:submit.prevent="login">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Email Or Username') }}</label>
                                        <input wire:model="username" class="form-control form-control-lg"
                                            type="text" name="email"
                                            placeholder="{{ __('Enter your Email Or Username') }}" />
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Password') }}</label>
                                        <div class="input-group" x-data="{ show: false }">
                                            <input
                                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                x-bind:type="!show ? 'password' : 'text'"
                                                placeholder="{{ __('Enter your password') }}"
                                                wire:model="password" />
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
                                    <div class="form-check align-items-center">
                                        <input id="customControlInline" type="checkbox" class="form-check-input"
                                            value="remember-me" wire:model="remember">
                                        <label class="form-check-label text-small" for="customControlInline">
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                    @error('credentials')
                                        <div class="pt-2 text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit"
                                            class="btn btn-lg btn-primary">{{ __('Sign in') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        {{ __('Forgot your password?') }}
                        <a href="{{ route('admin.auth.password.forgot') }}" wire:navigate>
                            {{ __('Reset password') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
