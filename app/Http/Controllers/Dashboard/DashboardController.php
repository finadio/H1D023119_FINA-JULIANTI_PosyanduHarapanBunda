<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Elderly;
use App\Models\ElderlyCheck;
use App\Models\EventSchedule;
use App\Models\FamilyChildren;
use App\Models\FamilyParent;
use App\Models\Immunization;
use App\Models\PregnancyCheck;
use App\Models\User;
use App\Models\Weighing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    // Membersihkan cache dashboard
    protected function clearDashboardCache(): void
    {
        Cache::forget($this->getTodayScheduleCacheKey());
        Cache::forget($this->getImmunizationYearsCacheKey());
        Cache::forget($this->getWeighingYearsCacheKey());
        Cache::forget($this->getPregnancyCheckYearsCacheKey()); // untuk global
        Cache::forget($this->getPregnancyCheckYearsCacheKey(Auth::user()?->parent_id)); // untuk parent login
        Cache::forget($this->getElderlyCheckYearsCacheKey());
        Cache::forget($this->getNutritionStatusYearsCacheKey());
        Cache::forget($this->getChildrenNutritionStatusYearsCacheKey());
    }

    // Halaman utama dashboard
    public function index()
    {
        $userCounts = $this->getUserCounts();
        $scheduleData = $this->getTodayScheduleData();
        $immunizationYearData = $this->getImmunizationYearData();
        $weighingYearData = $this->getWeighingYearData();
        $pregnancyCheckYearData = $this->getPregnancyCheckYearData();
        $elderlyCheckYearData = $this->getElderlyCheckYearData();
        $nutritionStatusYearData = $this->getNutritionStatusYearData();

        $childrenNutritionStatusYearData = [];
        if (Auth::user() && Auth::user()->role === 'family_parent') {
            $childrenNutritionStatusYearData = $this->getChildrenNutritionStatusYearData();
        }

        return view('dashboard.index', array_merge(
            $userCounts,
            $scheduleData,
            $immunizationYearData,
            $weighingYearData,
            $pregnancyCheckYearData,
            $elderlyCheckYearData,
            $nutritionStatusYearData,
            $childrenNutritionStatusYearData
        ));
    }

    // Mengambil data jumlah pengguna
    private function getUserCounts(): array
    {
        return [
            'adminCount'                => User::adminCount(),
            'midwifeCount'              => User::midwifeCount(),
            'officerCount'              => User::officerCount() + 1, // +1 untuk village_head
            'familyParentCount'         => User::familyParentCount(),
            'familyChildrenCount'       => FamilyChildren::familyChildrenCount(),
            'elderlyCount'              => Elderly::elderlyCount(),
        ];
    }

    // Mengambil data jadwal hari ini dari cache atau database
    private function getTodayScheduleData(): array
    {
        $cacheKey = $this->getTodayScheduleCacheKey();

            $todaySchedules = Cache::remember($cacheKey, now()->addMinutes(10), function () {
        return EventSchedule::whereDate('event_date', '>=', Carbon::today())
            ->orderBy('event_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->limit(5) // misal ambil 5 jadwal terdekat
            ->get();
    });

        return ['todaySchedules' => $todaySchedules];
    }

    // Membuat key cache untuk jadwal hari ini
    private function getTodayScheduleCacheKey(): string
    {
        return 'schedules_today_' . Carbon::today()->toDateString();
    }

    // Mengambil data tahun imunisasi dari cache atau database
    private function getImmunizationYearData(): array
    {
        $cacheKey = $this->getImmunizationYearsCacheKey();

        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $selectedImmunizationYear = Carbon::now()->year;

            $availableImmunizationYears = Immunization::selectRaw('YEAR(immunization_date) as year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year');

            return [
                'selectedImmunizationYear'    => $selectedImmunizationYear,
                'availableImmunizationYears'  => $availableImmunizationYears
            ];
        });
    }

    // Membuat key cache untuk data tahun imunisasi
    private function getImmunizationYearsCacheKey(): string
    {
        return 'immunization_years_' . Carbon::now()->year;
    }

    // Mengambil data tahun penimbangan dari cache atau database
    private function getWeighingYearData(): array
    {
        $cacheKey = $this->getWeighingYearsCacheKey();

        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $selectedWeighingYear = Carbon::now()->year;

            $availableWeighingYears = Weighing::selectRaw('YEAR(weighing_date) as year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year');

            return [
                'selectedWeighingYear'    => $selectedWeighingYear,
                'availableWeighingYears'  => $availableWeighingYears
            ];
        });
    }

    // Membuat key cache untuk data tahun penimbangan
    private function getWeighingYearsCacheKey(): string
    {
        return 'weighing_years_' . Carbon::now()->year;
    }

    // Mengambil data tahun pemeriksaan kehamilan dari cache atau database
    private function getPregnancyCheckYearData(): array
    {
        $user = Auth::user();
        $isParent = $user && $user->role === 'family_parent';

        if ($isParent) {
            // Ambil data parent berdasarkan parent_id dari user
            $parent = FamilyParent::find($user->parent_id);

            if ($parent) {
                // Buat key cache unik per parent
                $cacheKey = $this->getPregnancyCheckYearsCacheKey($parent->id);

                return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($parent) {
                    $selectedPregnancyCheckYear = Carbon::now()->year;

                    $availablePregnancyCheckYears = PregnancyCheck::selectRaw('YEAR(check_date) as year')
                        ->where('parent_id', $parent->id)
                        ->distinct()
                        ->orderByDesc('year')
                        ->pluck('year');

                    return [
                        'selectedPregnancyCheckYear'    => $selectedPregnancyCheckYear,
                        'availablePregnancyCheckYears'  => $availablePregnancyCheckYears
                    ];
                });
            }
        }

        // Jika bukan parent, ambil semua data
        $cacheKey = $this->getPregnancyCheckYearsCacheKey(); // default key (tanpa id parent)
        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $selectedPregnancyCheckYear = Carbon::now()->year;

            $availablePregnancyCheckYears = PregnancyCheck::selectRaw('YEAR(check_date) as year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year');

            return [
                'selectedPregnancyCheckYear'    => $selectedPregnancyCheckYear,
                'availablePregnancyCheckYears'  => $availablePregnancyCheckYears
            ];
        });
    }

    // Membuat key cache untuk data tahun pemeriksaan kehamilan
    private function getPregnancyCheckYearsCacheKey($parentId = null): string
    {
        $baseKey = 'pregnancy_check_years_' . Carbon::now()->year;
        return $parentId ? $baseKey . '_parent_' . $parentId : $baseKey . '_all';
    }

    // Mengambil data tahun pemeriksaan lansia dari cache atau database
    private function getElderlyCheckYearData(): array
    {
        $cacheKey = $this->getElderlyCheckYearsCacheKey();

        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $selectedElderlyCheckYear = Carbon::now()->year;

            $availableElderlyCheckYears = ElderlyCheck::selectRaw('YEAR(check_date) as year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year');

            return [
                'selectedElderlyCheckYear'    => $selectedElderlyCheckYear,
                'availableElderlyCheckYears'  => $availableElderlyCheckYears
            ];
        });
    }

    // Membuat key cache untuk data tahun pemeriksaan lansia
    private function getElderlyCheckYearsCacheKey(): string
    {
        return 'elderly_check_years_' . Carbon::now()->year;
    }

    // Mengambil data tahun status nutrisi dari cache atau database
    private function getNutritionStatusYearData(): array
    {
        $cacheKey = $this->getNutritionStatusYearsCacheKey();

        return Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $selectedNutritionStatusYear = Carbon::now()->year;

            $availableNutritionStatusYears = Weighing::selectRaw('YEAR(weighing_date) as year')
                ->distinct()
                ->orderByDesc('year')
                ->pluck('year');

            return [
                'selectedNutritionStatusYear'    => $selectedNutritionStatusYear,
                'availableNutritionStatusYears'  => $availableNutritionStatusYears
            ];
        });
    }

    // Membuat key cache untuk data tahun status nutrisi
    private function getNutritionStatusYearsCacheKey(): string
    {
        return 'nutrition_status_years_' . Carbon::now()->year;
    }

    // Mengambil data tahun status nutrisi dari cache atau database anak-anak
    private function getChildrenNutritionStatusYearData($parentId = null): array
    {
        if (Auth::user() && Auth::user()->role !== 'family_parent') {
            abort(403, 'Unauthorized');
        }

        $parent = FamilyParent::find(Auth::user()->parent_id);

        $parentId = $parent->id;

        $children = FamilyChildren::with(['familyParents'])
            ->where('parent_id', $parentId)
            ->orderBy('date_of_birth', 'desc')
            ->get();

        $cacheKey = $this->getChildrenNutritionStatusYearsCacheKey();

        // Cache data berdasarkan parent ID
        $data = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($children) {
            $selectedWeighingYear = Carbon::now()->year;

            $availableWeighingYears = collect();
            $childrenYears = [];

            foreach ($children as $child) {
                $years = Weighing::selectRaw('YEAR(weighing_date) as year')
                    ->where('children_id', $child->id)
                    ->pluck('year');

                $availableWeighingYears = $availableWeighingYears->merge($years);

                $childYears = $years->unique()->sortDesc()->values();

                // Cek apakah tahun ini tersedia
                if ($childYears->contains($selectedWeighingYear)) {
                    $childrenYears[$child->id] = $selectedWeighingYear;
                } else {
                    // Ambil tahun terbaru jika tahun ini tidak tersedia
                    $childrenYears[$child->id] = $childYears->first();
                }
            }

            $availableWeighingYears = $availableWeighingYears->unique()->sortDesc()->values();

            return [
                'selectedWeighingYear'   => $selectedWeighingYear,
                'availableWeighingYears' => $availableWeighingYears,
                'childrenYears'          => $childrenYears, // hasil tahun masing-masing anak
            ];
        });

        // Tambahkan data anak ke hasil akhir
        $data['children'] = $children;

        return $data;
    }

    // Membuat key cache untuk data tahun status nutrisi anak-anak
    private function getChildrenNutritionStatusYearsCacheKey(): string
    {
        return 'children_nutrition_status_years_' . Carbon::now()->year;
    }

    // Hapus semua cache dashboard
    public function clearAllDashboardCache()
    {
        // Memanggil method untuk membersihkan cache dashboard
        $this->clearDashboardCache();

        // Redirect kembali ke halaman dashboard setelah cache dibersihkan
        return redirect()->route('dashboard');
    }
}
