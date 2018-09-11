@extends('layout.default')
@extends('snippets.navigation')

@section('title')
    Dashboard | Sense Plant
@endsection

@section('stylesheets')
    <link href="{{ asset('/css/default.css') }}" rel="stylesheet">
@endsection

@section('main-content')
    <div class="container-fluid" style="margin-top: 0">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Planten</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" style="position: relative;top: 5px;left: -3px;" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="24px" height="24px"><g><g><path d="M506.791,186.581c-17.89-55.053-77.234-85.287-132.283-67.403c-7.272,2.363-14.634,5.631-21.91,9.68    c1.603-8.169,2.436-16.182,2.436-23.828c0-58.447-40.387-104.981-97.982-104.981c-57.679,0-100.086,46.637-100.086,104.981    c0,7.645,0.833,15.658,2.436,23.828c-7.276-4.048-14.638-7.317-21.91-9.68C82.446,101.291,23.098,131.528,5.209,186.581    c-18.142,55.838,12.726,118.021,67.403,135.788c7.272,2.363,15.148,4.045,23.414,5.047c-6.099,5.668-11.481,11.661-15.976,17.846    C46.025,392.094,56.444,457.876,103.274,491.9c46.808,34.01,107.605,23.759,141.74-23.225c4.495-6.186,8.529-13.158,12.037-20.71    c3.507,7.553,7.542,14.524,12.037,20.71c34.181,47.048,92.928,57.162,139.636,23.225c46.831-34.025,57.25-99.807,23.225-146.638    c-4.493-6.186-9.878-12.178-15.976-17.847c8.264-1.001,16.145-2.685,23.417-5.046C494.066,304.603,524.933,242.42,506.791,186.581    z M257.052,30.044c39.394,0,67.987,31.536,67.987,74.986c0,19.556-7.653,43.667-20.471,64.497    c-1.551,2.521-2.268,5.33-2.222,8.099l-15.616,27.028c-4.67-2.021-9.78-3.588-14.881-4.627V138.53    c0-8.282-6.515-14.997-14.797-14.997c-8.282,0-14.997,6.715-14.997,14.997v61.498c-5.221,1.064-10.239,2.686-15.007,4.775    l-17.435-28.556c-0.175-2.314-0.888-4.618-2.182-6.72c-12.818-20.83-20.471-44.941-20.471-64.497    C186.961,62.281,217.093,30.044,257.052,30.044z M81.88,293.843c-38.539-12.523-61.037-58.314-48.145-97.993    c12.778-39.324,55.162-60.921,94.489-48.146c16.144,5.246,33.771,17.046,48.512,32.256l25.755,42.184    c-4.094,4.347-7.675,9.179-10.647,14.404l-58.527-19.016c-7.884-2.561-16.339,1.752-18.898,9.628    c-2.561,7.878,1.752,16.338,9.628,18.898l58.505,19.01c-0.678,6.02-0.632,11.422,0.037,17.164l-37.46,13.069    C122.678,300.014,99.332,299.513,81.88,293.843z M242.053,387.296c-1.939,24.232-9.884,48.032-21.303,63.749    c-24.406,33.59-66.469,40.839-99.845,16.589c-33.45-24.304-40.891-71.29-16.588-104.742    c19.857-27.333,54.348-39.752,56.964-41.457l30.712-10.715c2.766,4.816,6.037,9.306,9.764,13.375l-36.175,49.792    c-4.869,6.701-3.383,16.08,3.317,20.948c6.697,4.867,16.077,3.385,20.948-3.317l36.165-49.779    c5.074,2.317,10.44,4.102,16.04,5.243V387.296z M257.052,318.497c-24.808,0-44.992-20.183-44.992-44.992    s20.183-44.992,44.992-44.992c24.808,0,44.992,20.183,44.992,44.992S281.86,318.497,257.052,318.497z M391.094,467.634    c-34.467,25.043-74.131,15.904-97.741-16.589c-11.419-15.717-19.564-39.517-21.505-63.748v-40.314    c5.6-1.142,11.166-2.925,16.24-5.243l36.165,49.779c4.869,6.701,14.248,8.185,20.948,3.317c6.701-4.869,8.187-14.247,3.317-20.948    l-36.174-49.791c3.695-4.036,6.943-8.483,9.694-13.254l27.954,10.071c3.446,2.555,37.543,14.246,57.689,41.978    C431.987,396.344,424.545,443.33,391.094,467.634z M368.012,295.523l-36.516-13.156c0.699-5.9,0.725-11.338,0.054-17.3    l58.505-19.01c7.877-2.56,12.188-11.02,9.628-18.898s-11.021-12.189-18.898-9.628l-58.527,19.016    c-3.024-5.315-6.678-10.224-10.862-14.629l24.769-42.868c14.556-14.767,31.791-26.206,47.61-31.346    c39.321-12.775,81.71,8.821,94.489,48.144c12.892,39.68-9.606,85.471-48.145,97.994h0.001    C412.962,299.417,390.11,299.983,368.012,295.523z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                Plant 1
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" style="position: relative;top: 5px;left: -3px;" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="24px" height="24px"><g><g><path d="M506.791,186.581c-17.89-55.053-77.234-85.287-132.283-67.403c-7.272,2.363-14.634,5.631-21.91,9.68    c1.603-8.169,2.436-16.182,2.436-23.828c0-58.447-40.387-104.981-97.982-104.981c-57.679,0-100.086,46.637-100.086,104.981    c0,7.645,0.833,15.658,2.436,23.828c-7.276-4.048-14.638-7.317-21.91-9.68C82.446,101.291,23.098,131.528,5.209,186.581    c-18.142,55.838,12.726,118.021,67.403,135.788c7.272,2.363,15.148,4.045,23.414,5.047c-6.099,5.668-11.481,11.661-15.976,17.846    C46.025,392.094,56.444,457.876,103.274,491.9c46.808,34.01,107.605,23.759,141.74-23.225c4.495-6.186,8.529-13.158,12.037-20.71    c3.507,7.553,7.542,14.524,12.037,20.71c34.181,47.048,92.928,57.162,139.636,23.225c46.831-34.025,57.25-99.807,23.225-146.638    c-4.493-6.186-9.878-12.178-15.976-17.847c8.264-1.001,16.145-2.685,23.417-5.046C494.066,304.603,524.933,242.42,506.791,186.581    z M257.052,30.044c39.394,0,67.987,31.536,67.987,74.986c0,19.556-7.653,43.667-20.471,64.497    c-1.551,2.521-2.268,5.33-2.222,8.099l-15.616,27.028c-4.67-2.021-9.78-3.588-14.881-4.627V138.53    c0-8.282-6.515-14.997-14.797-14.997c-8.282,0-14.997,6.715-14.997,14.997v61.498c-5.221,1.064-10.239,2.686-15.007,4.775    l-17.435-28.556c-0.175-2.314-0.888-4.618-2.182-6.72c-12.818-20.83-20.471-44.941-20.471-64.497    C186.961,62.281,217.093,30.044,257.052,30.044z M81.88,293.843c-38.539-12.523-61.037-58.314-48.145-97.993    c12.778-39.324,55.162-60.921,94.489-48.146c16.144,5.246,33.771,17.046,48.512,32.256l25.755,42.184    c-4.094,4.347-7.675,9.179-10.647,14.404l-58.527-19.016c-7.884-2.561-16.339,1.752-18.898,9.628    c-2.561,7.878,1.752,16.338,9.628,18.898l58.505,19.01c-0.678,6.02-0.632,11.422,0.037,17.164l-37.46,13.069    C122.678,300.014,99.332,299.513,81.88,293.843z M242.053,387.296c-1.939,24.232-9.884,48.032-21.303,63.749    c-24.406,33.59-66.469,40.839-99.845,16.589c-33.45-24.304-40.891-71.29-16.588-104.742    c19.857-27.333,54.348-39.752,56.964-41.457l30.712-10.715c2.766,4.816,6.037,9.306,9.764,13.375l-36.175,49.792    c-4.869,6.701-3.383,16.08,3.317,20.948c6.697,4.867,16.077,3.385,20.948-3.317l36.165-49.779    c5.074,2.317,10.44,4.102,16.04,5.243V387.296z M257.052,318.497c-24.808,0-44.992-20.183-44.992-44.992    s20.183-44.992,44.992-44.992c24.808,0,44.992,20.183,44.992,44.992S281.86,318.497,257.052,318.497z M391.094,467.634    c-34.467,25.043-74.131,15.904-97.741-16.589c-11.419-15.717-19.564-39.517-21.505-63.748v-40.314    c5.6-1.142,11.166-2.925,16.24-5.243l36.165,49.779c4.869,6.701,14.248,8.185,20.948,3.317c6.701-4.869,8.187-14.247,3.317-20.948    l-36.174-49.791c3.695-4.036,6.943-8.483,9.694-13.254l27.954,10.071c3.446,2.555,37.543,14.246,57.689,41.978    C431.987,396.344,424.545,443.33,391.094,467.634z M368.012,295.523l-36.516-13.156c0.699-5.9,0.725-11.338,0.054-17.3    l58.505-19.01c7.877-2.56,12.188-11.02,9.628-18.898s-11.021-12.189-18.898-9.628l-58.527,19.016    c-3.024-5.315-6.678-10.224-10.862-14.629l24.769-42.868c14.556-14.767,31.791-26.206,47.61-31.346    c39.321-12.775,81.71,8.821,94.489,48.144c12.892,39.68-9.606,85.471-48.145,97.994h0.001    C412.962,299.417,390.11,299.983,368.012,295.523z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                Plant 2
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" style="position: relative;top: 5px;left: -3px;" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="24px" height="24px"><g><g><path d="M506.791,186.581c-17.89-55.053-77.234-85.287-132.283-67.403c-7.272,2.363-14.634,5.631-21.91,9.68    c1.603-8.169,2.436-16.182,2.436-23.828c0-58.447-40.387-104.981-97.982-104.981c-57.679,0-100.086,46.637-100.086,104.981    c0,7.645,0.833,15.658,2.436,23.828c-7.276-4.048-14.638-7.317-21.91-9.68C82.446,101.291,23.098,131.528,5.209,186.581    c-18.142,55.838,12.726,118.021,67.403,135.788c7.272,2.363,15.148,4.045,23.414,5.047c-6.099,5.668-11.481,11.661-15.976,17.846    C46.025,392.094,56.444,457.876,103.274,491.9c46.808,34.01,107.605,23.759,141.74-23.225c4.495-6.186,8.529-13.158,12.037-20.71    c3.507,7.553,7.542,14.524,12.037,20.71c34.181,47.048,92.928,57.162,139.636,23.225c46.831-34.025,57.25-99.807,23.225-146.638    c-4.493-6.186-9.878-12.178-15.976-17.847c8.264-1.001,16.145-2.685,23.417-5.046C494.066,304.603,524.933,242.42,506.791,186.581    z M257.052,30.044c39.394,0,67.987,31.536,67.987,74.986c0,19.556-7.653,43.667-20.471,64.497    c-1.551,2.521-2.268,5.33-2.222,8.099l-15.616,27.028c-4.67-2.021-9.78-3.588-14.881-4.627V138.53    c0-8.282-6.515-14.997-14.797-14.997c-8.282,0-14.997,6.715-14.997,14.997v61.498c-5.221,1.064-10.239,2.686-15.007,4.775    l-17.435-28.556c-0.175-2.314-0.888-4.618-2.182-6.72c-12.818-20.83-20.471-44.941-20.471-64.497    C186.961,62.281,217.093,30.044,257.052,30.044z M81.88,293.843c-38.539-12.523-61.037-58.314-48.145-97.993    c12.778-39.324,55.162-60.921,94.489-48.146c16.144,5.246,33.771,17.046,48.512,32.256l25.755,42.184    c-4.094,4.347-7.675,9.179-10.647,14.404l-58.527-19.016c-7.884-2.561-16.339,1.752-18.898,9.628    c-2.561,7.878,1.752,16.338,9.628,18.898l58.505,19.01c-0.678,6.02-0.632,11.422,0.037,17.164l-37.46,13.069    C122.678,300.014,99.332,299.513,81.88,293.843z M242.053,387.296c-1.939,24.232-9.884,48.032-21.303,63.749    c-24.406,33.59-66.469,40.839-99.845,16.589c-33.45-24.304-40.891-71.29-16.588-104.742    c19.857-27.333,54.348-39.752,56.964-41.457l30.712-10.715c2.766,4.816,6.037,9.306,9.764,13.375l-36.175,49.792    c-4.869,6.701-3.383,16.08,3.317,20.948c6.697,4.867,16.077,3.385,20.948-3.317l36.165-49.779    c5.074,2.317,10.44,4.102,16.04,5.243V387.296z M257.052,318.497c-24.808,0-44.992-20.183-44.992-44.992    s20.183-44.992,44.992-44.992c24.808,0,44.992,20.183,44.992,44.992S281.86,318.497,257.052,318.497z M391.094,467.634    c-34.467,25.043-74.131,15.904-97.741-16.589c-11.419-15.717-19.564-39.517-21.505-63.748v-40.314    c5.6-1.142,11.166-2.925,16.24-5.243l36.165,49.779c4.869,6.701,14.248,8.185,20.948,3.317c6.701-4.869,8.187-14.247,3.317-20.948    l-36.174-49.791c3.695-4.036,6.943-8.483,9.694-13.254l27.954,10.071c3.446,2.555,37.543,14.246,57.689,41.978    C431.987,396.344,424.545,443.33,391.094,467.634z M368.012,295.523l-36.516-13.156c0.699-5.9,0.725-11.338,0.054-17.3    l58.505-19.01c7.877-2.56,12.188-11.02,9.628-18.898s-11.021-12.189-18.898-9.628l-58.527,19.016    c-3.024-5.315-6.678-10.224-10.862-14.629l24.769-42.868c14.556-14.767,31.791-26.206,47.61-31.346    c39.321-12.775,81.71,8.821,94.489,48.144c12.892,39.68-9.606,85.471-48.145,97.994h0.001    C412.962,299.417,390.11,299.983,368.012,295.523z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                Plant 3
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseMood" aria-expanded="false" aria-controls="collapseExample">
                    Stemming
                </button>

                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseWater" aria-expanded="false" aria-controls="collapseExample">
                    Waterniveau
                </button>

                <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseTemp" aria-expanded="false" aria-controls="collapseExample">
                    Temperatuur
                </button>

                <br><br>

                <div class="collapse" id="collapseMood">
                    <canvas class="my-4 chartjs-render-monitor" id="moodChart" width="1538" height="449" style="display: block; width: 1538px; height: 649px;"></canvas>
                </div>
                <div class="collapse" id="collapseWater">
                    <canvas class="my-4 chartjs-render-monitor" id="waterChart" width="1538" height="449" style="display: block; width: 1538px; height: 649px;"></canvas>
                </div>
                <div class="collapse" id="collapseTemp">
                    <canvas class="my-4 chartjs-render-monitor" id="tempChart" width="1538" height="449" style="display: block; width: 1538px; height: 649px;"></canvas>
                </div>
                <h2>Plant gegevens</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Tijd</th>
                            <th>Stemming</th>
                            <th>Waterniveau</th>
                            <th>Temperatuur</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>09:08 11-09-2018</td>
                            <td><img src="{{ asset('/images/sad.svg') }}" alt="Sad Plant"/></td>
                            <td>1232</td>
                            <td>20'</td>
                        </tr>
                        <tr>
                            <td>09:18 11-09-2018</td>
                            <td><img src="{{ asset('/images/neutral.svg') }}" alt="Neutral Plant"/></td>
                            <td>1246</td>
                            <td>22'</td>
                        </tr>
                        <tr>
                            <td>09:28 11-09-2018</td>
                            <td><img src="{{ asset('/images/happy.svg') }}" alt="Happy Plant"/></td>
                            <td>1268</td>
                            <td>23'</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="{{ asset('/js/chart.js') }}"></script>
@endsection

