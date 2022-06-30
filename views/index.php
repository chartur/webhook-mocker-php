<?php $this->layout("layouts.main") ?>

<?php $this->section("content") ?>
<div>
    <div class="text-center">
        <img class="logo" alt="logo; webhook mocker" src="/public/images/logos/logo.png">
    </div>
    <div class="mt-2 mb-2">
        <h6 class="text-center">
            Webhook requests mocking and testing in real-time.
            <br>
            You just need to input simple subdomain to generate your Webhook URL address.
        </h6>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div class="url-container">
            <div class="input-group mb-3">
                <input id="subdomain-input" name="subdomain" type="text" class="subdomain-input form-control" placeholder="subdomain">
                <button class="btn btn-primary" type="button">. <?= config("BACKEND_HOST.HOST") ?></button>
            </div>
            
            <p id="error-message" class="text-danger text-center"></p>
            
            <div class="text-center mt-4">
                <button id="submit" disabled class="btn btn-info">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    <span class="d-inline-block">Generate URL</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>


<?php $this->section("scripts") ?>
    <script src="/public/js/validator.js"></script>

    <script>
        const subdomainInputElement = document.getElementById("subdomain-input");
        const submitButton = document.getElementById("submit");
        const errorAlert = document.getElementById("error-message");
        
        rxjs.fromEvent(subdomainInputElement, "input")
            .subscribe((event) => {
                const value = event.target.value.toLowerCase().trim();
                const validation = validate.single(value, {
                    presence: {
                        allowEmpty: false,
                        message: "Subdomain is required"
                    },
                    format: {
                        pattern: "^([a-zA-Z0-9][a-zA-Z0-9-_])*[a-zA-Z0-9]*[a-zA-Z0-9-_]*[[a-zA-Z0-9]+$",
                        message: "Subdomain value is invalid"
                    },
                    length: {
                        minimum: 5,
                        message: "The minimum length for a subdomain value is 5."
                    }
                })
                const isInvalid = !!validation;
                submitButton.disabled = isInvalid;
                errorAlert.innerText = isInvalid ? validation[0] : "";
            });
        
        rxjs.fromEvent(submitButton, "click")
            .pipe(
                rxjs.map(() => subdomainInputElement.value)
            )
            .subscribe((subdomain) => {
                window.location.href = `<?= config("BACKEND_HOST.CABINET_URL") ?>?subdomain=${subdomain}`
            })
    </script>
<?php $this->endSection() ?>



