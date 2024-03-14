
<footer class="mt-5" style="background-color: #363e61; color: white;">
    <div class="container pb-5 pt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-card">
                    <h3 class="text-white">Get In Touch</h3>
                    <p>Welcome to WebMart Feel free to shop. <br>
                    Battisputali Street, Kathmandu, Nepal <br>
                    exampl@example.com <br>
                    000 000 0000</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-card">
                    <h3 class="text-white">Important Links</h3>
                    <ul>
                        @foreach ($pages as $page)
                        <li><a href="{{ route('footer.page',$page->slug) }}"  class="text-white" title="{{ $page->name }}">{{ $page->name??'' }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-card">
                    <h3 class="text-white">Follow Us</h3>
                    <ul class="list-unstyled">
                        <li class="d-inline-block m-2">
                            <a href="https://www.facebook.com/profile.php?id=61556675918891&mibextid=hu50Ix" target="_blank" title="Facebook" class="text-white">
                            <i class="ri-facebook-box-fill fs-3"></i>
                            Facebook</a>
                        </li>
                        <li class="d-inline-block m-2">
                            <i class="ri-twitter-fill fs-3"></i>
                            <a href="#" title="Twitter" class="text-white">Twitter</a>
                        </li>
                        <li class="d-inline-block m-2">
                            <i class="ri-instagram-fill fs-3"></i>
                            <a href="#" title="Instagram" class="text-white">Instagram</a>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="copy-right text-center">
                        <p>© Copyright 2024 WebMart. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
