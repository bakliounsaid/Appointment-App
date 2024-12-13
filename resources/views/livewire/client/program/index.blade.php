<div>
    <!-- Main Content -->
    <div class="container pb-4" style="padding-top: 120px">
        <form class="row shadow-lg g-3 align-items-end bg-white p-3 my-5">
            <div class="col-md-4">
                <label class="form-label">Departure City</label>
                <div class="input-group">
                    <span class="input-group-text bg-gold-500">
                        <svg width="20" height="20" fill="currentColor" class="text-white"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                        </svg>
                    </span>
                    <input type="text" class="form-control border-gold-500" id="departureCity"
                        placeholder="Select your city">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Check-in Date</label>
                <div class="input-group">
                    <span class="input-group-text bg-gold-500">
                        <svg width="20" height="20" fill="currentColor" class="text-white"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M96 32l0 32L48 64C21.5 64 0 85.5 0 112l0 48 448 0 0-48c0-26.5-21.5-48-48-48l-48 0 0-32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 32L160 64l0-32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192L0 192 0 464c0 26.5 21.5 48 48 48l352 0c26.5 0 48-21.5 48-48l0-272z" />
                        </svg>
                    </span>
                    <input type="date" class="form-control border-gold-500" id="departureDate">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Travelers</label>
                <div class="input-group">
                    <span class="input-group-text bg-gold-500">
                        <svg width="20" height="20" fill="currentColor" class="text-white"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path
                                d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM609.3 512l-137.8 0c5.4-9.4 8.6-20.3 8.6-32l0-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2l61.4 0C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z" />
                        </svg>
                    </span>
                    <select class="form-select border-gold-500" id="travelers">
                        <option value="">Select travelers</option>
                        <option value="1">1 Traveler</option>
                        <option value="2">2 Travelers</option>
                        <option value="3">3 Travelers</option>
                        <option value="4">4+ Travelers</option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row">
            @livewire('client.program.filters')

            <!-- Search Results -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Found 24 packages</h5>
                    <select class="form-select sort-select" style="width: auto;">
                        <option>Sort by: Recommended</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Rating: High to Low</option>
                    </select>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                        <div class="card hotel-card shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img style="background-size: contain"
                                        src="https://www.besthotelinmecca.net/data/Photos/OriginalPhoto/9343/934346/934346305/photo-reefaf-al-mashaer-hotel-13145-mecca-1.JPEG"
                                        class="img-fluid h-100 object-fit-cover"
                                        alt="Hotel">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title mb-0">Dar Al Tawhid Intercontinental</h5>
                                            <span class="badge gold-success">Premium</span>
                                        </div>
                                        <div class="rating-stars mb-2">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <span class="ms-2 text-muted">(4.8/5)</span>
                                        </div>
                                        <p class="text-muted mb-3">
                                            <i class="bi bi-geo-alt me-1"></i>200m from Al-Haram
                                        </p>
                                        <div class="d-flex gap-2 flex-wrap mb-3">
                                            <span class="amenity-tag">Free WiFi</span>
                                            <span class="amenity-tag">Restaurant</span>
                                            <span class="amenity-tag">Prayer Room</span>
                                            <span class="amenity-tag">Room Service</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div>
                                                <p class="mb-0 text-muted">Starting from</p>
                                                <h4 class="text-success mb-0">5,999 SAR</h4>
                                                <small class="text-muted">per person</small>
                                            </div>
                                            <a href="{{ route('client.programs.show') }}"
                                                class="btn btn-success px-4">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
