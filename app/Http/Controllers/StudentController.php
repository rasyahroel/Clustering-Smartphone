<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Category;
use App\Models\LeftAudiogram;
use App\Models\RightAudiogram;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LeftAudiogramResource;

class StudentController extends Controller
{
    public function index()
    {
        // Mengubah title pencarian
        $title = '';

        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' berkategori ' . $category->name;
        }

        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = ' by ' . $user->name;
        }

        // Menghitung total data
        $scount = Student::where('user_id', Auth::user()->id)->filter(request(['search','category','user']))->count();
        $scountp = Student::where('user_id', Auth::user()->id)->filter(request(['search','category','user']))->where('gender', 'P')->count();
        $scountl = Student::where('user_id', Auth::user()->id)->filter(request(['search','category','user']))->where('gender', 'L')->count();

        // Paginate data
        $students =  Student::latest()->where('user_id', Auth::user()->id)->filter(request(['search','category','user']))->paginate(5)->withQueryString();
        return view('students', [
            
            'title' => 'Data Siswa' . $title,
            'students' => $students,
            'scount' => $scount,
            'scountp' => $scountp,
            'scountl' => $scountl
        ]);
    }

    public function show(Student $student)
    {
        // Transformasi data interpretasi
        if($student->left_interpretasi->l_low == 1){
            $lill = 'R';
        }else if($student->left_interpretasi->l_low == 2){
            $lill = 'N';
        }else{
            $lill = 'T';
        }

        if($student->left_interpretasi->l_high == 1){
            $lilh = 'R';
        }else if($student->left_interpretasi->l_high == 2){
            $lilh = 'N';
        }else{
            $lilh = 'T';
        }

        if($student->right_interpretasi->r_low == 1){
            $rirl = 'R';
        }else if($student->right_interpretasi->r_low == 2){
            $rirl = 'N';
        }else{
            $rirl = 'T';
        }

        if($student->right_interpretasi->r_low == 1){
            $rirh = 'R';
        }else if($student->right_interpretasi->r_low == 2){
            $rirh = 'N';
        }else{
            $rirh = 'T';
        }


        return view('student', [
            'title' => "Data Siswa $student->name",
            'student' => $student,
            'lill' => $lill,
            'lilh' => $lilh,
            'rirl' => $rirl,
            'rirh'  => $rirh
        ]);
    }


    // Left Min Max
    public function l_min($table){
        return LeftAudiogram::whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->min($table);
    }

    public function l_max($table){
        return LeftAudiogram::whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->max($table);
    }

    public function llh_min($table){
        return LeftAudiogram::join('left_interpretasis', 'left_audiograms.id', '=', 'left_interpretasis.left_id')
        ->whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->min($table);
    }

    public function llh_max($table){
        return LeftAudiogram::join('left_interpretasis', 'left_audiograms.id', '=', 'left_interpretasis.left_id')
        ->whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->max($table);
    }


    // Right Min Max
    public function r_min($table){
        return RightAudiogram::whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->min($table);
    }

    public function r_max($table){
        return RightAudiogram::whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->max($table);
    }

    public function rlh_min($table){
        return RightAudiogram::join('right_interpretasis', 'right_audiograms.id', '=', 'right_interpretasis.right_id')
        ->whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->min($table);
    }

    public function rlh_max($table){
        return RightAudiogram::join('right_interpretasis', 'right_audiograms.id', '=', 'right_interpretasis.right_id')
        ->whereHas('students', function($query){
            $query->where('user_id', Auth::user()->id);
        })->max($table);
    }


    public function normalisasi(Student $student){
        $left_audiogram = LeftAudiogram::where('student_id', $student->id)->join('left_interpretasis', 'left_audiograms.id', '=', 'left_interpretasis.left_id')->first();
        $right_audiogram = RightAudiogram::where('student_id', $student->id)->join('right_interpretasis', 'right_audiograms.id', '=', 'right_interpretasis.right_id')->first();

        // Left audiogram
        $l500_min = $this->l_min('l_500');
        $l500_max = $this->l_max('l_500');

        $l1000_min = $this->l_min('l_1000');
        $l1000_max = $this->l_max('l_1000');

        $l2000_min = $this->l_min('l_2000');
        $l2000_max = $this->l_max('l_2000');

        $l3000_min = $this->l_min('l_3000');
        $l3000_max = $this->l_max('l_3000');

        $l4000_min = $this->l_min('l_4000');
        $l4000_max = $this->l_max('l_4000');

        $l6000_min = $this->l_min('l_6000');
        $l6000_max = $this->l_max('l_6000');

        // Left Interpretasi
        $ll_min = $this->llh_min('l_low');
        $ll_max = $this->llh_max('l_low');

        $lh_min = $this->llh_min('l_high');
        $lh_max = $this->llh_max('l_high');


        // Right Audiogram
        $r500_min = $this->r_min('r_500');
        $r500_max = $this->r_max('r_500');

        $r1000_min = $this->r_min('r_1000');
        $r1000_max = $this->r_max('r_1000');

        $r2000_min = $this->r_min('r_2000');
        $r2000_max = $this->r_max('r_2000');

        $r3000_min = $this->r_min('r_3000');
        $r3000_max = $this->r_max('r_3000');

        $r4000_min = $this->r_min('r_4000');
        $r4000_max = $this->r_max('r_4000');

        $r6000_min = $this->r_min('r_6000');
        $r6000_max = $this->r_max('r_6000');

        // Right Interpretasi
        $rl_min = $this->rlh_min('r_low');
        $rl_max = $this->rlh_max('r_low');

        $rh_min = $this->rlh_min('r_high');
        $rh_max = $this->rlh_max('r_high');


        // Left Normalisasi
        $nl_500 = number_format((($left_audiogram->l_500 - $l500_min) / ($l500_max - $l500_min)), 3);
        $nl_1000 = number_format((($left_audiogram->l_1000 - $l1000_min) / ($l1000_max - $l1000_min)), 3);
        $nl_2000 = number_format((($left_audiogram->l_2000 - $l2000_min) / ($l2000_max - $l2000_min)), 3);
        $nl_3000 = number_format((($left_audiogram->l_3000 - $l3000_min) / ($l3000_max - $l3000_min)), 3);
        $nl_4000 = number_format((($left_audiogram->l_4000 - $l4000_min) / ($l4000_max - $l4000_min)), 3);
        $nl_6000 = number_format((($left_audiogram->l_6000 - $l6000_min) / ($l6000_max - $l6000_min)), 3);
        $nl_low = number_format((($left_audiogram->left_interpretasis->l_low - $ll_min) / ($ll_max - $ll_min)), 3);
        $nl_high = number_format((($left_audiogram->left_interpretasis->l_high - $lh_min) / ($lh_max - $lh_min)), 3);

        // Right Normalisasi
        $nr_500 = number_format((($right_audiogram->r_500 - $r500_min) / ($r500_max - $r500_min)), 3);
        $nr_1000 = number_format((($right_audiogram->r_1000 - $r1000_min) / ($r1000_max - $r1000_min)), 3);
        $nr_2000 = number_format((($right_audiogram->r_2000 - $r2000_min) / ($r2000_max - $r2000_min)), 3);
        $nr_3000 = number_format((($right_audiogram->r_3000 - $r3000_min) / ($r3000_max - $r3000_min)), 3);
        $nr_4000 = number_format((($right_audiogram->r_4000 - $r4000_min) / ($r4000_max - $r4000_min)), 3);
        $nr_6000 = number_format((($right_audiogram->r_6000 - $r6000_min) / ($r6000_max - $r6000_min)), 3);
        $nr_low = number_format((($right_audiogram->right_interpretasis->r_low - $rl_min) / ($rl_max - $rl_min)), 3);
        $nr_high = number_format((($right_audiogram->right_interpretasis->r_high - $rh_min) / ($rh_max - $rh_min)), 3);
        
        // dd($nl_1000);

        return [
            'nl_500' => $nl_500,
            'nl_1000' => $nl_1000, 
            'nl_2000' => $nl_2000, 
            'nl_3000' => $nl_3000, 
            'nl_4000' => $nl_4000, 
            'nl_6000' => $nl_6000, 
            'nl_low' => $nl_low, 
            'nl_high' => $nl_high, 
            'nr_500' => $nr_500, 
            'nr_1000' => $nr_1000, 
            'nr_2000' => $nr_2000, 
            'nr_3000' => $nr_3000, 
            'nr_4000' => $nr_4000, 
            'nr_6000' => $nr_6000, 
            'nr_low' => $nr_low, 
            'nr_high' => $nr_high
        ];

    }

    // Melihat 1 data klastering
    // public function medoid(Student $student){
    //     $data_uji = $this->normalisasi($student);
    //     $students = Student::where('user_id', $student->id)->inRandomOrder()->limit(3)->get();
    //     foreach($students as $student){
    //         echo $student->name ."<br/>";

    //         $normalisasi = $this->normalisasi($student);
    //         // Jarak Euclidean
    //         $je = sqrt(pow(($normalisasi['nl_500'] - $data_uji['nl_500']), 2) + pow(($normalisasi['nl_1000'] - $data_uji['nl_1000']), 2) + pow(($normalisasi['nl_2000'] - $data_uji['nl_2000']), 2) + pow(($normalisasi['nl_3000'] - $data_uji['nl_3000']), 2) + pow(($normalisasi['nl_4000'] - $data_uji['nl_4000']), 2) + pow(($normalisasi['nl_6000'] - $data_uji['nl_6000']), 2) + pow(($normalisasi['nl_low']- $data_uji['nl_low']), 2) + pow(($normalisasi['nl_high'] - $data_uji['nl_high']), 2) + pow(($normalisasi['nr_500'] - $data_uji['nr_500']), 2) + pow(($normalisasi['nr_1000'] - $data_uji['nr_1000']), 2) + pow(($normalisasi['nr_2000'] - $data_uji['nr_2000']), 2) + pow(($normalisasi['nr_3000'] - $data_uji['nr_3000']), 2) + pow(($normalisasi['nr_4000'] - $data_uji['nr_4000']), 2) + pow(($normalisasi['nr_6000'] - $data_uji['nr_6000']), 2) + pow(($normalisasi['nr_low'] - $data_uji['nr_low']), 2) + pow(($normalisasi['nr_high'] - $normalisasi['nr_high']), 2));
    //         echo $je . "<br/><br/>";
    //     }
    // }

    // Menampilkan semua data klastering
    public function medoid_all()
    {
        $data_siswa = Student::where('user_id', Auth::user()->id)->get();
        // Data medoid random
        $students = Student::where('user_id', Auth::user()->id)->inRandomOrder()->limit(3)->get();
        $total = 0;
        $j = 0; // Perulangan untuk indeks all siswa
        foreach($data_siswa as $siswa){
            $data_uji = $this->normalisasi($siswa);
            echo 'Siswa : ' . $siswa->name . '<br/>';
            $i = 0; // Perulangan medoid
            foreach($students as $student){
                $id[$i] = $student->id;
                echo 'Pembanding : ' . $student->name ."<br/>";

                $normalisasi = $this->normalisasi($student);
                // Jarak Euclidean
                $je = sqrt(pow(($normalisasi['nl_500'] - $data_uji['nl_500']), 2) + pow(($normalisasi['nl_1000'] - $data_uji['nl_1000']), 2) + pow(($normalisasi['nl_2000'] - $data_uji['nl_2000']), 2) + pow(($normalisasi['nl_3000'] - $data_uji['nl_3000']), 2) + pow(($normalisasi['nl_4000'] - $data_uji['nl_4000']), 2) + pow(($normalisasi['nl_6000'] - $data_uji['nl_6000']), 2) + pow(($normalisasi['nl_low']- $data_uji['nl_low']), 2) + pow(($normalisasi['nl_high'] - $data_uji['nl_high']), 2) + pow(($normalisasi['nr_500'] - $data_uji['nr_500']), 2) + pow(($normalisasi['nr_1000'] - $data_uji['nr_1000']), 2) + pow(($normalisasi['nr_2000'] - $data_uji['nr_2000']), 2) + pow(($normalisasi['nr_3000'] - $data_uji['nr_3000']), 2) + pow(($normalisasi['nr_4000'] - $data_uji['nr_4000']), 2) + pow(($normalisasi['nr_6000'] - $data_uji['nr_6000']), 2) + pow(($normalisasi['nr_low'] - $data_uji['nr_low']), 2) + pow(($normalisasi['nr_high'] - $normalisasi['nr_high']), 2));
                echo $je . "<br/><br/>";
                $array[$i] = $je;
                $i++;
            }
            echo 'Kedekatan = ' . min($array) .'<br/>' ;
            echo 'Kluster   = ' . array_search(min($array), $array) + 1 . '<br/>';
            
            $total = $total + min($array);
            $cluster[$j] = array_search(min($array), $array)+1;
            $j++;
            echo '-------------------------------------------<br/>';

        }
        echo 'Total Kedekatan = ' . $total;

        echo '<br/>=====================================================<br/>';

        // Iterasi
        $students2 = Student::where('user_id', Auth::user()->id)->whereNotIn('id', $id)->inRandomOrder()->limit(3)->get();
        $total2 = 0;
        foreach($data_siswa as $siswa){
            $data_uji = $this->normalisasi($siswa);
            echo 'Siswa : ' . $siswa->name . '<br/>';
            $i = 0;
            foreach($students2 as $student){
                $id[$i] = $student->id;
                echo 'Pembanding : ' . $student->name ."<br/>";

                $normalisasi = $this->normalisasi($student);
                // Jarak Euclidean
                $je = sqrt(pow(($normalisasi['nl_500'] - $data_uji['nl_500']), 2) + pow(($normalisasi['nl_1000'] - $data_uji['nl_1000']), 2) + pow(($normalisasi['nl_2000'] - $data_uji['nl_2000']), 2) + pow(($normalisasi['nl_3000'] - $data_uji['nl_3000']), 2) + pow(($normalisasi['nl_4000'] - $data_uji['nl_4000']), 2) + pow(($normalisasi['nl_6000'] - $data_uji['nl_6000']), 2) + pow(($normalisasi['nl_low']- $data_uji['nl_low']), 2) + pow(($normalisasi['nl_high'] - $data_uji['nl_high']), 2) + pow(($normalisasi['nr_500'] - $data_uji['nr_500']), 2) + pow(($normalisasi['nr_1000'] - $data_uji['nr_1000']), 2) + pow(($normalisasi['nr_2000'] - $data_uji['nr_2000']), 2) + pow(($normalisasi['nr_3000'] - $data_uji['nr_3000']), 2) + pow(($normalisasi['nr_4000'] - $data_uji['nr_4000']), 2) + pow(($normalisasi['nr_6000'] - $data_uji['nr_6000']), 2) + pow(($normalisasi['nr_low'] - $data_uji['nr_low']), 2) + pow(($normalisasi['nr_high'] - $normalisasi['nr_high']), 2));
                echo $je . "<br/><br/>";
                $array[$i] = $je;
                $i++;
            }
            echo 'Kedekatan = ' . min($array) .'<br/>' ;
            echo 'Kluster   = ' . array_search(min($array), $array)+1 . '<br/>';
            
            $total2 = $total2 + min($array);
            echo '-------------------------------------------<br/>';
        }
        echo 'Total Kedekatan = ' . $total2;


        // Menghitung selisih kedekatan iterasi dengan data medoid
        echo "<br/> Selisih Total = " . $total2 - $total;

        // Menentukan klaster tiap siswa
        if($total2 - $total > 0){
            foreach($data_siswa as $key => $siswa){
                $siswa->category_id = $cluster[$key];
                $siswa->save();
            }
        }
    }
}
