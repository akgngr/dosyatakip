<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<!-- Users, Roles Permissions -->
@can('show-user')
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Kullanıcı Yönetimi</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Kullanıcılar</span></a></li>
        <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roller</span></a></li>
        <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>İzinler</span></a></li>
    </ul>
</li>
@endcan

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Genel İşlemler</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li ><a class="nav-link" href="{{backpack_url('icra/arama')}}"><i class="fa fa-search"></i>Arama Yap</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/kategori')}}"><i class="fa fa-suitcase"></i> Kategoriler</a></li>
        <li><a href="{{ route('infaz.create') }}" class="nav-link" data-style="zoom-in"><i class="fa fa-plus"></i> Yeni Mahkeme Dosyası Ekle</a></li>        
        <li><a href="{{ route('icra.create') }}" class="nav-link" data-style="zoom-in"><i class="fa fa-plus"></i> Yeni İcra Dosyası Ekle</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Tüm İcralar</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li ><a class="nav-link" href="{{backpack_url('icra/1.icra')}}"><i class="fa fa-tag"></i>1. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/2.icra')}}"><i class="fa fa-newspaper-o"></i>2. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/3.icra')}}"><i class="fa fa-list"></i>3. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/4.icra')}}"><i class="fa fa-list"></i>4. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/dis/icra')}}"><i class="fa fa-tag"></i>Dış İcralar</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/gapel_1.icra')}}"><i class="fa fa-tag"></i>Gapel 1. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/gapel_2.icra')}}"><i class="fa fa-tag"></i>Gapel 2. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/gapel_3.icra')}}"><i class="fa fa-tag"></i>Gapel 3. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/gapel_4.icra')}}"><i class="fa fa-tag"></i>Gapel 4. İcra</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Tüm İcra İnfazları</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/birinci/icra')}}"><i class="fa fa-tag"></i>1. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/ikinci/icra')}}"><i class="fa fa-newspaper-o"></i>2. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/ucuncu/icra')}}"><i class="fa fa-list"></i>3. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/dorduncu/icra')}}"><i class="fa fa-list"></i>4. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/dis/icra')}}"><i class="fa fa-tag"></i>Dış İcralar</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/gapel/birinci/icra')}}"><i class="fa fa-tag"></i>Gapel 1. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/gapel/ikinci/icra')}}"><i class="fa fa-tag"></i>Gapel 2. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/gapel/ucuncu/icra')}}"><i class="fa fa-tag"></i>Gapel 3. İcra</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/gapel/dorduncu/icra')}}"><i class="fa fa-tag"></i>Gapel 4. İcra</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Tüm Mahkemeler</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li ><a class="nav-link" href="{{backpack_url('icra/mahkeme/is_ve_aile')}}"><i class="fa fa-tag"></i>İş ve Aile Mahkemesi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/mahkeme/asliye_tuketici')}}"><i class="fa fa-newspaper-o"></i>Asliye-Sulh Tüketici Mahkemsi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/mahkeme/cek')}}"><i class="fa fa-list"></i>Çek Şikayetleri</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/mahkeme/ceza')}}"><i class="fa fa-list"></i>Ceza Mahkemesi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/mahkeme/icra_hukuk')}}"><i class="fa fa-tag"></i>İcra Hukuk Mahkemesi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/mahkeme/savcilik')}}"><i class="fa fa-tag"></i>Savcılık</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/mahkeme/gapel')}}"><i class="fa fa-tag"></i>Gapel Mahkemesi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-newspaper-o"></i> <span>Tüm Mahkeme İnfazları</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/mahkeme/is_ve_aile')}}"><i class="fa fa-tag"></i>İş ve Aile Mahkemesi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/mahkeme/asliye_tuketici')}}"><i class="fa fa-newspaper-o"></i>Asliye-Sulh Tüketici Mahkemsi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/mahkeme/cek')}}"><i class="fa fa-list"></i>Çek Şikayetleri</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/mahkeme/ceza')}}"><i class="fa fa-list"></i>Ceza Mahkemesi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/mahkeme/icra_hukuk')}}"><i class="fa fa-tag"></i>İcra Hukuk Mahkemesi</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/mahkeme/savcilik')}}"><i class="fa fa-tag"></i>Savcılık</a></li>
        <li ><a class="nav-link" href="{{backpack_url('icra/infaz/mahkeme/gapel')}}"><i class="fa fa-tag"></i>Gapel Mahkemesi</a></li>
    </ul>
</li>