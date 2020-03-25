<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@home');

Route::group([
    'prefix' => 'admin/icra',
    'middleware' => ['web']
],
    function () {
    Route::get('/', 'HomeController@index');
    Route::resource('kategori', 'KategoriController');

    Route::get('infaz/infaz_infaz_data', 'InfazDosyasiController@infaz_infaz_data');
    Route::get('infaz/infaz_data', 'InfazDosyasiController@infaz_derdest_data');
    Route::get('icra/derdest', 'IcraDosyasiController@icra_derdest_data');
    Route::get('icra/infaz-data', 'IcraDosyasiController@icra_infaz_data');
    
    Route::get('icra/infazlari', 'IcraDosyasiController@index_infaz')->name('icra.infaz');
    Route::get('infaz/infazlari', 'InfazDosyasiController@index_infaz')->name('infaz.infaz');


    Route::resource('icra', 'IcraDosyasiController');
    Route::resource('infaz', 'InfazDosyasiController');

    Route::post('icra/kaydet', 'YorumController@store')->name('icra.kaydet');
    Route::post('infaz/kaydet', 'YorumController@infaz_store')->name('infaz.kaydet');
    Route::delete('yorum/sil/{id}', 'YorumController@destroy')->name('yorum.sil');

    Route::post('tahsilat/kaydet', 'TahsilatController@alacak_store')->name('tahsilat.alacak');
    Route::post('tahsilat/alinan', 'TahsilatController@alinan_store')->name('tahsilat.alinan');
    Route::delete('tahsilat/alinansil/{id}', 'TahsilatController@alinan_delete')->name('tahsilat.alinansil');
    Route::delete('tahsilat/alacaksil/{id}', 'TahsilatController@alacak_delete')->name('tahsilat.alacaksil');


    Route::get('/icra/tahsilat/alinan/makbuz/{id}',  'PrintController@icra_alinan_print')->name('icra.alinan.makbuz');
    Route::get('/mahkeme/tahsilat/alinan/makbuz/{id}',  'PrintController@mahkeme_alinan_print')->name('mahkeme.alinan.makbuz');

    Route::get('/arama', 'SearchController@index')->name('arama');
    Route::post('/arama', 'SearchController@arama')->name('search');


    /*
     * İcra
     */


    Route::get('/1.icra', 'IcraShowController@birinci_icra');
    Route::get('/1.icra/data', 'IcraShowController@birinci_icra_data');
    Route::get('/1.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/1.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/2.icra', 'IcraShowController@ikinci_icra');
    Route::get('/2.icra/data', 'IcraShowController@ikinci_icra_data');
    Route::get('/2.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/2.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/3.icra', 'IcraShowController@ucuncu_icra');
    Route::get('/3.icra/data', 'IcraShowController@ucuncu_icra_data');
    Route::get('/3.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/3.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/4.icra', 'IcraShowController@dorduncu_icra');
    Route::get('/4.icra/data', 'IcraShowController@dorduncu_icra_data');
    Route::get('/4.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/4.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/dis/icra', 'IcraShowController@dis_icra');
    Route::get('/dis/icra/data', 'IcraShowController@dis_icra_data');
    Route::get('/dis/icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/dis/icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/gapel_1.icra', 'IcraShowController@gapel_birinci_icra');
    Route::get('/gapel_1.icra/data', 'IcraShowController@gapel_birinci_icra_data');
    Route::get('/gapel_1.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/gapel_1.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/gapel_2.icra', 'IcraShowController@gapel_ikinci_icra');
    Route::get('/gapel_2.icra/data', 'IcraShowController@gapel_ikinci_icra_data');
    Route::get('/gapel_2.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/gapel_2.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/gapel_3.icra', 'IcraShowController@gapel_ucuncu_icra');
    Route::get('/gapel_3.icra/data', 'IcraShowController@gapel_ucuncu_icra_data');
    Route::get('/gapel_3.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/gapel_3.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/gapel_4.icra', 'IcraShowController@gapel_dorduncu_icra');
    Route::get('/gapel_4.icra/data', 'IcraShowController@gapel_dorduncu_icra_data');
    Route::get('/gapel_4.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/gapel_4.icra/{id}/edit', 'IcraDosyasiController@edit');

    /*
     * İcra İnfazları
    */

    Route::get('/infaz/birinci/icra', 'IcraShowController@birinci_icra_infaz');
    Route::get('/1.icra/infaz/data', 'IcraShowController@birinci_icra_data_infaz');
    Route::get('/infaz/1.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/1.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/ikinci/icra', 'IcraShowController@ikinci_icra_infaz');
    Route::get('/2.icra/infaz/data', 'IcraShowController@ikinci_icra_data_infaz');
    Route::get('/infaz/2.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/2.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/ucuncu/icra', 'IcraShowController@ucuncu_icra_infaz');
    Route::get('/3.icra/infaz/data', 'IcraShowController@ucuncu_icra_data_infaz');
    Route::get('/infaz/3.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/3.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/dorduncu/icra', 'IcraShowController@dorduncu_icra_infaz');
    Route::get('/4.icra/infaz/data', 'IcraShowController@dorduncu_icra_data_infaz');
    Route::get('/infaz/4.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/4.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/dis/icra', 'IcraShowController@dis_icra_infaz');
    Route::get('/dis/icra/infaz/data', 'IcraShowController@dis_icra_data_infaz');
    Route::get('/infaz/dis/icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/dis/icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/gapel/birinci/icra', 'IcraShowController@gapel_birinci_icra_infaz');
    Route::get('/gapel_1.icra/infaz/data', 'IcraShowController@gapel_birinci_icra_data_infaz');
    Route::get('/infaz/gapel_1.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/gapel_1.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/gapel/ikinci/icra', 'IcraShowController@gapel_ikinci_icra_infaz');
    Route::get('/gapel_2.icra/infaz/data', 'IcraShowController@gapel_ikinci_icra_data_infaz');
    Route::get('/infaz/gapel_2.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/gapel_2.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/gapel/ucuncu/icra', 'IcraShowController@gapel_ucuncu_icra_infaz');
    Route::get('/gapel_3.icra/infaz/data', 'IcraShowController@gapel_ucuncu_icra_data_infaz');
    Route::get('/infaz/gapel_3.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/gapel_3.icra/{id}/edit', 'IcraDosyasiController@edit');

    Route::get('/infaz/gapel/dorduncu/icra', 'IcraShowController@gapel_dorduncu_icra_infaz');
    Route::get('/gapel_4.icra/infaz/data', 'IcraShowController@gapel_dorduncu_icra_data_infaz');
    Route::get('/infaz/gapel_4.icra/show/{id}', 'IcraDosyasiController@show');
    Route::get('/infaz/gapel_4.icra/{id}/edit', 'IcraDosyasiController@edit');


    /*
     * Mahkme
    */

    Route::get('/mahkeme/is_ve_aile', 'MahkemeShowController@is_ve_aile');
    Route::get('/mahkeme/is_ve_aile/data', 'MahkemeShowController@is_ve_aile_data');
    Route::get('/mahkeme/is_ve_aile/show/{id}', 'InfazDosyasiController@show');
    Route::get('/mahkeme/is_ve_aile/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/mahkeme/asliye_tuketici', 'MahkemeShowController@asliye_tuketici');
    Route::get('/mahkeme/asliye_tuketici/data', 'MahkemeShowController@asliye_tuketici_data');
    Route::get('/mahkeme/asliye_tuketici/show/{id}', 'InfazDosyasiController@show');
    Route::get('/mahkeme/asliye_tuketici/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/mahkeme/cek', 'MahkemeShowController@cek');
    Route::get('/mahkeme/cek/data', 'MahkemeShowController@cek_data');
    Route::get('/mahkeme/cek/show/{id}', 'InfazDosyasiController@show');
    Route::get('/mahkeme/cek/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/mahkeme/ceza', 'MahkemeShowController@ceza');
    Route::get('/mahkeme/ceza/data', 'MahkemeShowController@ceza_data');
    Route::get('/mahkeme/ceza/show/{id}', 'InfazDosyasiController@show');
    Route::get('/mahkeme/ceza/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/mahkeme/icra_hukuk', 'MahkemeShowController@icra_hukuk');
    Route::get('/mahkeme/icra_hukuk/data', 'MahkemeShowController@icra_hukuk_data');
    Route::get('/mahkeme/icra_hukuk/show/{id}', 'InfazDosyasiController@show');
    Route::get('/mahkeme/icra_hukuk/{id}/edit', 'InfazDosyasiController@edit');


    Route::get('/mahkeme/savcilik', 'MahkemeShowController@savcilik');
    Route::get('/mahkeme/savcilik/data', 'MahkemeShowController@savcilik_data');
    Route::get('/mahkeme/savcilik/show/{id}', 'InfazDosyasiController@show');
    Route::get('/mahkeme/savcilik/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/mahkeme/gapel', 'MahkemeShowController@gapel');
    Route::get('/mahkeme/gapel/data', 'MahkemeShowController@gapel_data');
    Route::get('/mahkeme/gapel/show/{id}', 'InfazDosyasiController@show');
    Route::get('/mahkeme/gapel/{id}/edit', 'InfazDosyasiController@edit');

    /*
     * Mahkme İnfaz
    */

    Route::get('/infaz/mahkeme/is_ve_aile', 'MahkemeShowController@is_ve_aile_infaz');
    Route::get('/mahkeme/infaz/is_ve_aile/data', 'MahkemeShowController@is_ve_aile_infaz_data');
    Route::get('/infaz/mahkeme/is_ve_aile/show/{id}', 'InfazDosyasiController@show');
    Route::get('/infaz/mahkeme/is_ve_aile/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/infaz/mahkeme/asliye_tuketici', 'MahkemeShowController@asliye_tuketici_infaz');
    Route::get('/mahkeme/infaz/asliye_tuketici/data', 'MahkemeShowController@asliye_tuketici_infaz_data');
    Route::get('/infaz/mahkeme/asliye_tuketici/show/{id}', 'InfazDosyasiController@show');
    Route::get('/infaz/mahkeme/asliye_tuketici/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/infaz/mahkeme/cek', 'MahkemeShowController@cek_infaz');
    Route::get('/mahkeme/infaz/cek/data', 'MahkemeShowController@cek_infaz_data');
    Route::get('/infaz/mahkeme/cek/show/{id}', 'InfazDosyasiController@show');
    Route::get('/infaz/mahkeme/cek/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/infaz/mahkeme/ceza', 'MahkemeShowController@ceza_infaz');
    Route::get('/mahkeme/infaz/ceza/data', 'MahkemeShowController@ceza_infaz_data');
    Route::get('/infaz/mahkeme/ceza/show/{id}', 'InfazDosyasiController@show');
    Route::get('/infaz/mahkeme/ceza/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/infaz/mahkeme/icra_hukuk', 'MahkemeShowController@icra_hukuk_infaz');
    Route::get('/mahkeme/infaz/icra_hukuk/data', 'MahkemeShowController@icra_hukuk_infaz_data');
    Route::get('/infaz/mahkeme/icra_hukuk/show/{id}', 'InfazDosyasiController@show');
    Route::get('/infaz/mahkeme/icra_hukuk/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/infaz/mahkeme/savcilik', 'MahkemeShowController@savcilik_infaz');
    Route::get('/mahkeme/infaz/savcilik/data', 'MahkemeShowController@savcilik_infaz_data');
    Route::get('/infaz/mahkeme/savcilik/show/{id}', 'InfazDosyasiController@show');
    Route::get('/infaz/mahkeme/savcilik/{id}/edit', 'InfazDosyasiController@edit');

    Route::get('/infaz/mahkeme/gapel', 'MahkemeShowController@gapel_infaz');
    Route::get('/mahkeme/infaz/gapel/data', 'MahkemeShowController@gapel_infaz_data');
    Route::get('/infaz/mahkeme/gapel/show/{id}', 'InfazDosyasiController@show');
    Route::get('/infaz/mahkeme/gapel/{id}/edit', 'InfazDosyasiController@edit');


    /*
     * İcra Dosyası Föy Numaraları Kaydetme
     */

    Route::post('icra/derdest/foyno/kaydet', 'FoyController@icra_derdest_foyno_kaydet')->name('icra.derdest.kaydet');
    Route::post('icra/infaz/foyno/kaydet', 'FoyController@icra_infaz_foyno_kaydet')->name('icra.infaz.kaydet');

    /*
     * Mahkeme Dosyası Föy Numaraları Kaydetme
     */

    Route::post('mahkeme/derdest/foyno/kaydet', 'FoyController@mahkeme_derdest_foyno_kaydet')->name('mahkeme.derdest.kaydet');
    Route::post('mahkeme/infaz/foyno/kaydet', 'FoyController@mahkeme_infaz_foyno_kaydet')->name('mahkeme.infaz.kaydet');
}
);

