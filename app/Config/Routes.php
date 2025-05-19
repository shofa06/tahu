<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', 'AuthentikasiController::login');
$routes->post('login/proses', 'AuthentikasiController::proses');

$routes->get('/', 'Pelanggan\PemesananController::index');
$routes->get('/pemesanan', 'Pelanggan\PemesananController::index');
$routes->get('/pesan-produk', 'Pelanggan\PemesananController::pesan');
$routes->post('order', 'Pelanggan\PemesananController::simpan');

$routes->get('admin/dashboard', 'admin\DashboardController::index');
$routes->get('admin/produk', 'admin\ProdukController::index');
$routes->get('admin/produk/create', 'admin\ProdukController::create');
$routes->get('admin/produk/tambah', 'admin\ProdukController::tambah');
$routes->get('admin/produk/edit/(:num)', 'admin\ProdukController::edit/$1');
$routes->post('admin/produk/simpan', 'admin\ProdukController::simpan');
$routes->get('admin/produk/hapus/(:num)', 'admin\ProdukController::hapus/$1');
$routes->put('admin/produk/update/(:num)', 'admin\ProdukController::update/$1');

$routes->get('admin/kategori', 'admin\KategoriController::index');
$routes->get('admin/kategori/edit/(:num)', 'admin\KategoriController::edit/$1');
$routes->put('admin/kategori/update/(:num)', 'admin\KategoriController::update/$1');
$routes->get('admin/kategori/delete/(:num)', 'admin\KategoriController::delete/$1');
$routes->get('admin/kategori/tambah', 'admin\KategoriController::tambah');
$routes->post('admin/kategori/simpan', 'admin\KategoriController::simpan');
$routes->get('admin/kategori/hapus/(:num)', 'admin\KategoriController::hapus/$1');

$routes->get('admin/pesanan', 'admin\PesananController::index');

$routes->get('admin/pengguna', 'admin\PenggunaController::index');
$routes->get('admin/pengguna/edit/(:num)', 'admin\PenggunaController::edit/$1');
$routes->put('admin/pengguna/update/(:num)', 'admin\PenggunaController::update/$1');
$routes->get('admin/pengguna/tambah', 'admin\PenggunaController::tambah');
$routes->post('admin/pengguna/simpan', 'admin\PenggunaController::simpan');
$routes->get('admin/pengguna/hapus/(:num)', 'admin\PenggunaController::hapus/$1');

$routes->get('admin/profil', 'admin\ProfilController::index');
$routes->get('admin/profil/edit', 'admin\ProfilController::edit');
$routes->post('admin/profil/update', 'admin\ProfilController::update');

$routes->get('karyawan/dashboard', 'karyawan\DashboardControllerKaryawan::index');
$routes->get('karyawan/pesanan', 'karyawan\PesananControllerKaryawan::index');
$routes->post('karyawan/pesanan/status/(:num)', 'karyawan\PesananControllerKaryawan::ubahStatus/$1');
$routes->get('karyawan/transaksi_pembayaran', 'karyawan\TransaksiPembayaranController::index');

$routes->get('pelanggan/dashboard', 'pelanggan\DashboardControllerPelanggan::index');
$routes->get('pelanggan/pesanan-keranjang', 'pelanggan\PesananKeranjangController::index');
$routes->get('pelanggan/arsip-pembayaran', 'pelanggan\ArsipPembayaranController::index');