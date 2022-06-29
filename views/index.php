<div>
    <div class="text-center">
        <img class="logo" alt="logo; webhook mocker" src="/public/images/logos/logo.png">
    </div>
    <div class="mt-2 mb-2">
        <h6 class="text-center">
            Webhook requests mocking and testing in real-time.
            <br>
            You just need to input simple subdomain to generate you Webhook URL address.
        </h6>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div class="url-container">
            <div class="input-group mb-3">
                <input name="subdomain" type="text" class="subdomain-input form-control" placeholder="subdomain">
                <button class="btn btn-primary" type="button">. <?= config("BACKEND_HOST") ?></button>
            </div>
            <div class="text-center mt-4">
                <button class="btn btn-info">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    <span class="d-inline-block">Generate URL</span>
                </button>
            </div>
        </div>
    </div>
</div>
