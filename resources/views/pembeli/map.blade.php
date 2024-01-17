@extends('pembeli.layouts.app')

@section('title', 'Maps')

@section('styles')
    <!-- {{-- cdn css leaflet  --}} -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <!-- {{-- cdn js leaflet --}} -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>

    <!-- {{-- cdn leaflet fullscreen js dan css --}} -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />

    <!-- {{-- cdn leaflet search --}} -->
    <link rel="stylesheet" href="{{ asset('css/leaflet-search.css') }}">
    <script src="{{ asset('js/leaflet-search.js') }}"></script>

    <!-- cdn leafle current location -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.css" rel="stylesheet">



    <style>
        #map {
            height: 80vh;
            width: 100%;
        }

        .leaflet-control-search .search-control {
            width: 250px;
        }

        .leaflet-control-search .search-input {
            width: 250px;
            height: 30px;
            padding: 7px;
            font-size: 14px;
        }

        .leaflet-control-search .search-tooltip {
            width: 292px;
            background-color: #ffffff;
        }

        @media (min-width: 768px) {
            .leaflet-control-search input[type=text] {
                display: block !important;
            }
        }

        .leaflet-control-search .search-tip {
            background-color: #F7FAFC;
        }

        .leaflet-control-search .search-button {
            margin-top: 6px;
            margin-bottom: 4px;
            margin-left: 3px;
            margin-right: 3px;
            width: 32px;
            height: 29px;
            font-size: 20px;
        }

        .leaflet-control-search .search-cancel {
            margin-top: 10px;
            margin-bottom: 4px;
            margin-left: 3px;
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .leaflet-control-search .search-control {
                width: 200px;
            }

            .leaflet-control-search .search-input {
                width: 200px;
                height: 30px;
                padding: 7px;
                font-size: 14px;
            }

            .leaflet-control-search .search-tooltip {
                width: 242px;
                background-color: #ffffff;
            }
        }
    </style>
@endsection

@section('content')
    <section class="p-lg-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('javascript')
    <script>
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicmVvbmFsZGkxNSIsImEiOiJjbHIydWN4Z2oxNW1rMnhsbWpoYW5lbDIwIn0._QV7HJJnzCin4a0O6VExWQ';

        var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            });

        var map = L.map('map', {
            // fullscreenControl: {
            //     pseudoFullscreen: false,
            //     position: 'bottomright',
            // },

            // Titik koordinat peta indonesia
            // untuk source code menampilkan peta pada halaman welcome ini masih sama seperti pada
            // halaman backend di file view spot, create.blade. Tapi pada halaman ini kita akan memunculkan 
            // marker dari masing-masing spot yang sudah ditambahkan dan ketika marker itu di klik akan memunculkan 
            // popup yang berisikan informasi dari spot tersebut dan juga tombol untuk melihat
            // rute dari lokasi kita ke lokasi spot yang kita pilih serta tombol detail untuk detail lengkap 
            // dari spot yang dipilih
            zoomControl: false,
            center: [-6.294875476718384, 106.58278553898865],
            zoom: 15,
            layers: [streets]
        });

        var baseLayers = {
            "Satellite": satellite,
            "Streets": streets,
            "Grayscale": dark,
        };

        var overlays = {
            "Streets": streets,
            "Satellite": satellite,
            "Grayscale": dark,
        };

        L.control.zoom({
            position: 'bottomright' // Set the position to bottom right
        }).addTo(map);

        // Get the zoom control element
        var zoomControl = document.getElementsByClassName('leaflet-control-zoom')[0];

        // Add a margin-bottom to the zoom control
        zoomControl.style.marginBottom = '40px';

        L.control.fullscreen({
            position: 'bottomright'
        }).addTo(map);

        var lc = L.control
            .locate({
                position: 'bottomright',
                strings: {
                    title: "Show me where I am, yo!"
                }
            })
            .addTo(map);

        // disini kita melakukan looping dari controller HomeController tepatnya dari method index
        // kemudian hasil dari looping tersebut kita masukkan kedalam function marker untuk memunculkan marker dari tiap-tiap
        // spot dan option bindPopoup.Jadi ketika salah satu amrker yang ada di klik akan memunculkan popup berupa informasi spot,
        // tombol cek rute dan tombol detail spot.
        var myIcon = L.icon({
            iconUrl: 'icon/store.svg',
            iconSize: [30, 40],
            iconAnchor: [20, 45],
            // size of the icon
        });

        @foreach ($warungs as $item)
            L.marker([{{ $item->location }}], {
                    icon: myIcon
                })
                .bindPopup(
                    "<div class='my-2'><img src='{{ Storage::url($item->image) }}' class='img-fluid' width='700px'></div>" +
                    "<div class='my-2'><strong>Nama Warung:</strong> <br>{{ $item->name }}</div>" +

                    "<div class='my-2'><a href='' class='btn btn-outline-primary btn-sm'>Lihat Rute</a> <a href='' class='btn btn-outline-success btn-sm'>Detail Warung</a></div>" +
                    "<div class='my-2'></div>"

                ).addTo(map);
        @endforeach

        // pada variable datas kita akan mendefinisikannya sebagai data array yang mana isian arraynya kita ambil dari
        // looping dari $spots dan variable datas ini akan kita loop lagi dalam perulangan for di bawah
        var datas = [
            @foreach ($warungs as $key => $value)
                {
                    "loc": [{{ $value->location }}],
                    "title": '{!! $value->name !!}'
                },
            @endforeach

        ];

        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);
        // var controlSearch = new L.Control.Search({
        //     position: 'topleft',
        //     layer: markersLayer,
        //     initial: false,
        //     zoom: 17,
        //     markerLocation: true
        // });

        // //menambahkan variabel controlsearch pada addControl
        // map.addControl(controlSearch);

        // looping variabel datas
        for (i in datas) {
            // lalu hasil loopingan tersebut kita definisikan ke dalam variabel baru,
            // title dan loc selanjutnya kita masukkan ke dalam variabel marker dan marker ini
            // yang akan kita pakai dalam option markersLayer

            // jadi ketika kkta melakukan pencarian data spot, nama dari spot tersebut akan muncul kemudian 
            // jika kita klik nama tersebut akan langsung di arahkan ke spot tersebut dan juga menampilkan marker dari spot itu
            // beserta popup yang berisi informasi spot.

            var title = datas[i].title,
                loc = datas[i].loc,
                marker = new L.Marker(new L.latLng(loc), {
                    title: title,
                    icon: myIcon
                });
            markersLayer.addLayer(marker);

            // melakukan looping data untuk memunculkan popup dari spot yang dipilih
            @foreach ($warungs as $item)
                L.marker([{{ $item->location }}], {
                        icon: myIcon
                    }, {
                        title: '{{ $item->title }}'
                    })
                    .bindPopup(
                        "<div class='my-2'><img src='{{ Storage::url($item->image) }}' class='img-fluid' width='700px'></div>" +
                        "<div class='my-2'><strong>Nama Spot:</strong> <br>{{ $item->name }}</div>" +

                        "<div class='my-2'><a href='{{ route('cek-rute', $item->id) }}' class='btn btn-outline-primary btn-sm'>Lihat Rute</a> <a href='/warung/{{ $item->id }}' class='btn btn-outline-success btn-sm'>Detail Warung</a></div>" +
                        "<div class='my-2'></div>"

                    ).addTo(map);
            @endforeach

        }

        L.control.layers(baseLayers, overlays).addTo(map);
    </script>
@endpush
