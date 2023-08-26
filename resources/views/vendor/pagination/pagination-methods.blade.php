@php
echo "count() : " . $paginator->count() . "<hr>";
echo "currentPage() : " . $paginator->currentPage() . "<hr>";
echo "firstItem() : " . $paginator->firstItem() . "<hr>";
echo "hasPages() : " . $paginator->hasPages() . "<hr>";
echo "hasMorePages() : " . $paginator->hasMorePages() . "<hr>";
echo "lastItem() : " . $paginator->lastItem() . "<hr>";
echo "lastPage() : " . $paginator->lastPage() . "<hr>";
echo "nextPageUrl() : " . $paginator->nextPageUrl() . "<hr>";
echo "onFirstPage() : " . $paginator->onFirstPage() . "<hr>";
echo "previousPageUrl() : " . $paginator->previousPageUrl() . "<hr>";
echo "total() : " . $paginator->total() . "<hr>";
echo "getPageName() : " . $paginator->getPageName() . "<hr>";
echo "url(5) : " . $paginator->url(5) . "<hr>";
echo "getOptions() : "; dump($paginator->getOptions()); echo "<hr>";
echo "items() : "; dump($paginator->items()); echo "<hr>";
echo "getUrlRange(2,4) : "; dump($paginator->getUrlRange(2,4)); echo "<hr>";
echo "\$elements : "; dump($elements); echo "<hr>";
@endphp

{{--
    # $paginator->count(): Tampilkan jumlah data untuk halaman saat ini.
    # $paginator->currentPage(): Tampilkan urutan halaman saat ini.
    # $paginator->firstItem(): Tampilkan urutan dari data pertama halaman saat ini.
    # $paginator->hasPages(): Apakah total data bisa dipecah ke dalam beberapa halaman.
    # $paginator->hasMorePages(): Apakah masih ada data berikutnya yang bisa ditampilkan.
    # $paginator->lastItem(): Tampilkan urutan dari data terakhir halaman saat ini
    # $paginator->lastPage(): Tampilkan angka untuk halaman terakhir (tidak tersedia jika menggunakan simplePaginate).
    # $paginator->nextPageUrl(): Tampilkan alamat URL untuk halaman berikutnya.
    # $paginator->onFirstPage(): Apakah halaman saat ini merupakan halaman pertama.
    # $paginator->previousPageUrl(): Tampilkan alamat URL untuk halaman sebelumnya.
    # $paginator->total(): Tampilkan jumlah total data (tidak tersedia jika menggunakan simplePaginate).
    # $paginator->getPageName(): Tampilan nama query string yang dipakai untuk menyimpan urutan halaman.
    # $paginator->url($page): Tampilkan URL halaman dari urutan halaman yang diinput sebagai argument.
    # $paginator->getOptions(): Tampilkan array dari paginator options.
    # $paginator->items(): Tampilkan array dari data untuk halaman saat ini.
    # $paginator->getUrlRange($start, $end): Generate array daftar nama halaman dari angka yang diinput ke dalam argument.
    # $elements: Array yang berisi daftar nama halaman
--}}
