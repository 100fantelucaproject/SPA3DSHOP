<template>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-dark shadow-top">
        <section class="">
            <div class="container text-center text-md-start pt-4">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">
                            <i class="fa-solid fa-cube"></i> 3D GLOBAL
                        </h5>
                        <p>
                            {{ $t("footer.description") }}
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">
                            {{ $t("footer.services") }}
                        </h5>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none fw-bold">Pro</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none fw-bold">{{ $t("footer.justInTime") }}</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none fw-bold">{{ $t("footer.customModel") }}</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none fw-bold">{{ $t("footer.other") }}</a>
                        </p>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">
                            {{ $t("footer.usefulLinks") }}
                        </h5>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none fw-bold">{{ $t("footer.aboutUs") }}</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none fw-bold">{{ $t("footer.whereUs") }}</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset text-decoration-none fw-bold">{{ $t("footer.help") }}</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h5 class="text-uppercase fw-bold mb-4">{{ $t("footer.contacts") }}</h5>
                        <p class="fw-bold"><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                        <p class="fw-bold">
                            <i class="fas fa-envelope me-3"></i>
                            info@example.com
                        </p>
                        <p class="fw-bold"><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p class="fw-bold"><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
        <hr class="bg-dark m-0">
        <section class="d-flex justify-content-center justify-content-lg-between p-3 border-bottom">
            <div class="me-5 d-none d-lg-block">
                <span>{{ $t("footer.social") }}:</span>
            </div>
            <div>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 text-reset">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </section>
        <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2022 Copyright:
            <a class="text-reset fw-bold">3D GLOBAL.com</a>
        </div>
    </footer>
    <!-- Footer -->
</template>

<style scoped>
.shadow-top {
    box-shadow: 0px -2px 16px 1px rgba(0, 0, 0, .2);
}
</style>