Velocity Child Berita 4
=======================

Child theme untuk WordPress parent theme Velocity System.

Versi: 2.0.0

Perubahan Pada Versi 2.0.0
--------------------------

- Menghapus ketergantungan Customizer child theme pada plugin Kirki.
- Mengganti ikon Font Awesome dengan ikon SVG Bootstrap 5.
- Menghapus field warna tema/background dari Customizer child theme dan memakai warna dari parent theme.
- Memperbarui output thumbnail agar memakai Bootstrap 5 `ratio` dengan fallback `no-image.webp`.
- Menghapus helper resize thumbnail lama dan penggunaan shortcode resize thumbnail.
- Mempertahankan shortcode `velocity-popular-posts` yang sudah ada sebelumnya.
- Menghapus logic hit counter dari child theme karena sudah disediakan oleh plugin Velocity Addons.
- Memperbarui class dan markup Bootstrap lama agar sesuai Bootstrap 5.
- Menambahkan guard/fallback untuk beberapa fungsi parent theme atau plugin yang dipakai child theme.
- Mengelompokkan pengaturan Customizer child theme dalam panel `Velocity Berita4`.
- Memperbaiki tampilan menu agar item panjang dapat turun ke baris berikutnya.

Cara Pakai
----------

Pasang atau unggah child theme melalui menu `Appearance > Themes`, lalu aktifkan setelah parent theme `velocity` tersedia dan aktif.

Catatan
-------

- Child theme ini tetap membutuhkan parent theme `velocity`.
- Beberapa fitur bergantung pada hook atau fungsi dari parent theme dan plugin Velocity terkait.
- Output gambar banner dan thumbnail dibuat agar menghindari nama class/id yang sensitif terhadap ad blocker.
