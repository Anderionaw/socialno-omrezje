@extends('layouts.main') 
@section('title', 'Nadzorna plošča')
@section('content')

    {{--
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush
    --}}

    {{--
    <div class="container-fluid">
    	<div class="row">
    		<!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('2,563')}}</h4>
                                <p class="mb-0">{{ __('Graf 1')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-cube f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('3,612')}}</h4>
                                <p class="mb-0">{{ __('Graf 2')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-shopping-cart f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('865')}}</h4>
                                <p class="mb-0">{{ __('Graf 3')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('35,500')}}</h4>
                                <p class="mb-0">{{ __('Graf 4')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <!-- page statustic chart end -->
            <!-- sale 2 card start -->
            <div class="col-md-6 col-xl-4">
                <div class="card sale-card">
                    <div class="card-header">
                        <h3>{{ __('Graf v živo')}}</h3>
                    </div>
                    <div class="card-block text-center">
                        <div id="realtime-profit"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card sale-card">
                    <div class="card-header">
                        <h3>{{ __('Graf 2')}}</h3>
                    </div>
                    <div class="card-block text-center">
                        <div id="sale-diff" class="chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="card card-green text-white">
                    <div class="card-block pb-0">
                        <div class="row mb-50">
                            <div class="col">
                                <h6 class="mb-5">{{ __('Mesečni  1')}}</h6>
                                <h5 class="mb-0  fw-700">{{ __('2665')}}</h5>
                            </div>
                            <div class="col-auto text-center">
                                <p class="mb-5">{{ __('Podatek 1')}}</p>
                                <h6 class="mb-0">{{ __('1768')}}</h6>
                            </div>

                            <div class="col-auto text-center">
                                <p class="mb-5">{{ __('Podatek 2')}}</p>
                                <h6 class="mb-0">{{ __('897')}}</h6>
                            </div>
                        </div>
                        <div id="sec-ecommerce-chart-line" class="chart-shadow"></div>
                        <div id="sec-ecommerce-chart-bar" ></div>
                    </div>
                </div>
            </div>
            <!-- sale 2 card end -->

            <!-- product and new customar start -->
            <div class="col-xl-4 col-md-6">
                <div class="card new-cust-card">
                    <div class="card-header">
                        <h3>{{ __('Novi vnosi družin')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="align-middle mb-25">
                            <div class="d-inline-block">
                                <a href="#!"><h6>Ime in priimek 1 (ER123456789)</h6></a>
                                <p class="text-muted mb-0">Testna ulica 13, 1000 Ljubljana</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <div class="d-inline-block">
                                <a href="#!"><h6>Ime in priimek 2 (ER123456785)</h6></a>
                                <p class="text-muted mb-0">Testna ulica 13, 1000 Ljubljana</p>
                                <span class="status active"></span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <div class="d-inline-block">
                                <a href="#!"><h6>Ime in priimek 3 (ER123456783)</h6></a>
                                <p class="text-muted mb-0">Testna ulica 13, 1000 Ljubljana</p>
                                <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>{{ __('pred 1 tednom')}}</span>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <div class="d-inline-block">
                                <a href="#!"><h6>Ime in priimek 4 (ER123456781)</h6></a>
                                <p class="text-muted mb-0">Testna ulica 13, 1000 Ljubljana</p>
                                <span class="status deactive text-mute"><i class="far fa-clock mr-10"></i>{{ __('pred 2 dnevi')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-6">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Nove vloge')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Status')}}</th>
                                        <th>{{ __('Evidenčna številka')}}</th>
                                        <th>{{ __('Ime in priimek')}}</th>
                                        <th>{{ __('Naslov')}}</th>
                                        <th>{{ __('Pošta in kraj')}}</th>
                                        <th>{{ __('Možnosti')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><div class="p-status bg-green"></div></td>    
                                        <td>VL1280987</td>
                                        <td>Ime in priimek</td>
                                        <td>Vojkova ulica 12</td>
                                        <td>1000 Ljubljana</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="p-status bg-red"></div></td>    
                                        <td>VL1280981</td>
                                        <td>Ime in priimek 2</td>
                                        <td>Novakova ulica 12</td>
                                        <td>2000 Maribor</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="p-status bg-green"></div></td>    
                                        <td>VL1280987</td>
                                        <td>Ime in priimek</td>
                                        <td>Vojkova ulica 12</td>
                                        <td>1000 Ljubljana</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="p-status bg-red"></div></td>    
                                        <td>VL1280981</td>
                                        <td>Ime in priimek 2</td>
                                        <td>Novakova ulica 12</td>
                                        <td>2000 Maribor</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="p-status bg-green"></div></td>    
                                        <td>VL1280987</td>
                                        <td>Ime in priimek</td>
                                        <td>Vojkova ulica 12</td>
                                        <td>1000 Ljubljana</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div class="p-status bg-red"></div></td>    
                                        <td>VL1280981</td>
                                        <td>Ime in priimek 2</td>
                                        <td>Novakova ulica 12</td>
                                        <td>2000 Maribor</td>
                                        <td>
                                            <a href="#!"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                            <a href="#!"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- product and new customar end -->
            <!-- Application Sales start -->
            <div class="col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h3>{{ __('Podatki o zneskih')}}</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block p-b-0">
                        <div class="table-responsive scroll-widget">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Evidenčna številka')}}</th>
                                        <th>{{ __('Ime in priimek')}}</th>
                                        <th>{{ __('Naslov')}}</th>
                                        <th>{{ __('Povprečni znesek')}}</th>
                                        <th>{{ __('Skupaj')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>VL1280987</td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>Ime in priimek 1</h6>
                                                <p class="text-muted mb-0">Vojkova 12, 1000 Ljubljana</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="app-sale1"></div>
                                        </td>
                                        <td>120,05 €</td>
                                        <td class="text-blue">2456,90 €</td>
                                    </tr>
                                    <tr>
                                        <td>VL1280981</td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>Ime in priimek 2</h6>
                                                <p class="text-muted mb-0">Novakova 12, 1000 Maribor</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="app-sale2"></div>
                                        </td>
                                        <td>100,00 €</td>
                                        <td class="text-blue">1456,90 €</td>
                                    </tr>
                                    <tr>
                                        <td>VL1280985</td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>Ime in priimek 3</h6>
                                                <p class="text-muted mb-0">Cvetkova cesta 23, 4000 Kranj</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="app-sale3"></div>
                                        </td>
                                        <td>111,05 €</td>
                                        <td class="text-blue">3456,90 €</td>
                                    </tr>
                                    <tr>
                                        <td>VL1280989</td>
                                        <td>
                                            <div class="d-inline-block align-middle">
                                                <h6>Ime in priimek 4</h6>
                                                <p class="text-muted mb-0">Seljakova ulica 42a, 5000 Nova Gorica</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="app-sale4"></div>
                                        </td>
                                        <td>140,20 €</td>
                                        <td class="text-blue">4556,70 €</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <a href="#!" class=" b-b-primary text-primary">{{ __('Poglej več')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Application Sales end -->
    	</div>
    </div>
    --}}

    {{--
	<!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
        <!-- <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> -->
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
       
        
        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>
        
    @endpush
    --}}

@endsection