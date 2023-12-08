<footer id="footer">
    <div class="container-fluid">
        <p class="mb-0 py-4 text-center">
            Copyright © by <a target="_blank" class="text-decoration-none" href="https://api.net.bd/">API</a>
            <script>
                document.write(new Date().getFullYear());
            </script>
        </p>
    </div>
</footer>


{{-- JS Scripts & Plugins --}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-precise-range-plugin@1.3.0/moment-precise-range.min.js"></script>
<script src="{{ asset('assets/js/responsive.js') }}"></script>
@yield('scripts')
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
