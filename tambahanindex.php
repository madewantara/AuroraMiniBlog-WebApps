<?php include('header.html');?>
    <div class="container mt-5">
        <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/carousel1.jpg" class="d-block w-100" alt="carousel">
                    <div class="carousel-caption text-dark">
                        <h3><b>INSPIRASI</b></h3>
                        <p>Lingkungan dan suasana yang nyaman merupakan salah satu hal penting dalam menemukan inspirasi</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/carousel2.jpg" class="d-block w-100" alt="carousel">
                    <div class="carousel-caption text-dark">
                        <h3><b>MENCOBA</b></h3>
                        <p>COBA MENULIS!!! Kita tidak akan pernah tau kemampuan kita sebelum mencoba.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/carousel3.png" class="d-block w-100" alt="carousel">
                    <div class="carousel-caption text-dark">
                        <h3><b>BATASAN</b></h3>
                        <p>Tidak ada kata terlalu tua atau terlalu muda untuk mulai menulis</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
<?php include('footer.html');?>