<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const scrollArea = document.querySelector('.scroll-wrapper');
    let scrollTimeout;

    scrollArea.addEventListener('scroll', () => {
        scrollArea.classList.add('scrolling');

        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            scrollArea.classList.remove('scrolling');
        }, 800); // scrollbar hilang setelah 800ms berhenti scroll
    });

</script>


@stack('script')

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'berhasil',
            text: '{{ session('success') }}',
            timer: 2000,
            ShowConfirm: false,
            toast: true,
            position: "top-end",
        });
    </script>
@endif
</body>

</html>
