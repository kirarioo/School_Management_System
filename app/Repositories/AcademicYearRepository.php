<?

namespace App\Repositories;

use App\Models\AcademicYear;

class AcademicYearRepository
{
    public function all()
    {
        return AcademicYear::latest()->get();
    }

    public function find($id)
    {
        return AcademicYear::findOrFail($id);
    }

    public function create(array $data)
    {
        return AcademicYear::create($data);
    }

    public function update($id, array $data)
    {
        $academicYear = $this->find($id);
        $academicYear->update($data);

        return $academicYear;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}