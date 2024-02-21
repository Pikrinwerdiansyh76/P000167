# CARA INSTALL
	1. Extract file WEBSITE.rar
	2. Create folder di htdocs dengan nama "P000167"
	3. Copy folder hasil extract file WEBSITE.rar ke Folder di htdocs dengan nama "P000167"
	4. Masuk ke folder "P000167"
	5. Masuk ke folder appweb > Config > SetWebsite.php
	6. Ubah Link $base_url menjadi "http://localhost/P000167"
	7. Ubah Link $base_url_admin menjadi "http://localhost/P000167/sistem"
	8. Ubah Link $short_url menjadi "localhost/P000167"
	9. Ubah Link $url_images menjadi "http://localhost/P000167/assets/files/images"
	10. Ubah Link $url_others menjadi "http://localhost/P000167/assets/files/others"
	11. Extract file DATABASE.rar
	12. Create database di phpMyAdmin dengan nama "project_p000167"
	13. Import file extract DATABASE.rar ke database dengan nama "project_p000167"

# ANALISIS DATABASE

1. akun
	- id_akun
	- username
	- password
	- nip_nuptk
	- nama
	- email
	- avatar
	- level 			('Administrator', 'Guru')
	- status 			('Active', 'Non-Active')
	- slug
	- session
	- terakhir_login

2. siswa
	- id_siswa
	- username
	- password
	- nisn
	- nama_siswa
	- nama_ibu
	- jenis_kelamin
	- avatar
	- status 			('Active', 'Non-Active')
	- slug
	- session
	- terakhir_login

3. pengaturan
	- ...

4. kelas
	- id_kelas
	- nama_kelas

5. semester
	- id_semester
	- nama_semester
	- tahun

6. mapel
	- id_mapel
	- nama_mapel

7. wali_kelas
	- id_wali_kelas
	- id_akun
	- id_kelas

8. jadwal_mengajar
	- id_jadwal_mengajar
	- id_semester
	- id_kelas
	- id_mapel
	- hari
	- jam
	- jam_ke

9. rombel
	- id_rombel
	- id_semester
	- id_kelas
	- id_siswa

10. absensi
	- id_absensi
	- id_semester
	- id_kelas
	- id_siswa
	- bulan
	- tanggal
	- waktu
	- hadir
	- sakit
	- izin
	- alpa

# AKSES LOGIN

Untuk sistemnya bisa diakses melalui laman https://www.sdn30dompu.my.id/

Dengan hak akses sebagai berikut:

1. Akun Administrator

Username: admin
Password: admin

2. Akun Guru

Username: hamid
Password: Hamid12345

Username: mustamin
Password: Mustamin12345

Username: rosmiati
Password: Rosmiati12345

Username: safaruddin
Password: Safaruddin12345

Username: sanri
Password: Sanri12345

Username: srirohayu
Password: SriRohayu12345

3. Akun Siswa

Username: siswa
Password: siswa

# REVISI v2 (22/01/2024)

1. ✅ Di bagian jadwal mengajar
2. ✅ Memperbaiki inputan jadwal mengajar
3. ✅ Memperbaiki tabel jadwal mengajar | *⚠️ (CATATAN: Perlu di perhatikan bahwa fitur Administrator & guru sedikit berbeda ya. Dimana jika kita login sebagai Administrator maka ada fitur memilih kelas dulu, hal ini bertujuan untuk mempermudah klasifikasi Jadwal Mengajar di setiap kelasnya. Namun ketika kita login sebagai guru, maka ketika kita klik menu Jadwal Mengajar maka hanya menampilkan Jadwal Mengajar guru tersebut!)*
4. ✅ Memperbaiki tabel data siswa
5. ✅ Memperbaiki inputan presensi
6. ✅ Memperbaiki cetak rekap presensi
7. ✅ Memperbaiki dashboard siswa, tabahin jadwal pelajaran sesuai dengan kelas yang di ampu siswa tersebut
8. ✅ Memperbaiki dashboard guru (statistik total guru & total siswa)
