<!-- Filters Sidebar -->
<div class="col-lg-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Filters</h5>

            <!-- Price Range -->
            <div class="mb-4">
                <h6 class="mb-3">Price Range</h6>
                <input type="range" class="range-slider w-100" min="1000" max="10000" value="5000">
                <div class="d-flex justify-content-between mt-2">
                    <span class="text-muted">1,000 SAR</span>
                    <span class="text-muted">10,000 SAR</span>
                </div>
            </div>

            <!-- Hotel Rating -->
            <div class="mb-4">
                <h6 class="mb-3">Hotel Rating</h6>
                <div class="d-flex flex-column gap-2">
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> 5 Stars
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> 4 Stars
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> 3 Stars
                    </label>
                </div>
            </div>

            <!-- Distance from Haram -->
            <div class="mb-4">
                <h6 class="mb-3">Distance from Haram</h6>
                <div class="d-flex flex-column gap-2">
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Less than 500m
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> 500m - 1km
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> 1km - 2km
                    </label>
                </div>
            </div>

            <!-- Hotel Amenities -->
            <div class="mb-4">
                <h6 class="mb-3">Hotel Amenities</h6>
                <div class="d-flex flex-column gap-2">
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Free WiFi
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Restaurant
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Prayer Room
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Room Service
                    </label>
                </div>
            </div>

            <!-- Package Type -->
            <div class="mb-4">
                <h6 class="mb-3">Package Type</h6>
                <div class="d-flex flex-column gap-2">
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Premium
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Standard
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="me-2"> Economy
                    </label>
                </div>
            </div>

            <button class="btn btn-success w-100">Apply Filters</button>
        </div>
    </div>
</div>
