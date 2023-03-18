@extends('layouts.main')

@section('content')
    <a href="/students" class="btn btn-info mb-4">Back to All Students</a>

    <div class="card mb-5 shadow">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $student->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Berkategori <a
                    href="/students?category={{ $student->category->slug }}">{{ $student->category->name }}</a></h6>
            <table class="table my-5">
                <thead>
                    <tr>
                        <th scope="col">Sekolah</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Umur</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $student->sch_name }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->age }}</td>
                    </tr>
                </tbody>
            </table>

            <h6 class="card-subtitle mb-2 text-muted">Audiogram Kiri</h6>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th scope="col">500</th>
                        <th scope="col">1000</th>
                        <th scope="col">2000</th>
                        <th scope="col">3000</th>
                        <th scope="col">4000</th>
                        <th scope="col">6000</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $student->left_audiogram->l_500 }}</td>
                        <td>{{ $student->left_audiogram->l_1000 }}</td>
                        <td>{{ $student->left_audiogram->l_2000 }}</td>
                        <td>{{ $student->left_audiogram->l_3000 }}</td>
                        <td>{{ $student->left_audiogram->l_4000 }}</td>
                        <td>{{ $student->left_audiogram->l_6000 }}</td>
                    </tr>
                </tbody>
            </table>

            <h6 class="card-subtitle mb-2 text-muted">Interpretasi Kiri</h6>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th scope="col">Frekuensi Rendah</th>
                        <th scope="col">Frekuensi Tinggi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $lill }}</td>
                        <td>{{ $lilh }}</td>
                    </tr>
                </tbody>
            </table>

            <h6 class="card-subtitle mb-2 text-muted">Audiogram Kanan</h6>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th scope="col">500</th>
                        <th scope="col">1000</th>
                        <th scope="col">2000</th>
                        <th scope="col">3000</th>
                        <th scope="col">4000</th>
                        <th scope="col">6000</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $student->right_audiogram->r_500 }}</td>
                        <td>{{ $student->right_audiogram->r_1000 }}</td>
                        <td>{{ $student->right_audiogram->r_2000 }}</td>
                        <td>{{ $student->right_audiogram->r_3000 }}</td>
                        <td>{{ $student->right_audiogram->r_4000 }}</td>
                        <td>{{ $student->right_audiogram->r_6000 }}</td>
                    </tr>
                </tbody>
            </table>

            <h6 class="card-subtitle mb-2 text-muted">Interpretasi Kanan</h6>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th scope="col">Frekuensi Rendah</th>
                        <th scope="col">Frekuensi Tinggi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $rirl }}</td>
                        <td>{{ $rirh }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
