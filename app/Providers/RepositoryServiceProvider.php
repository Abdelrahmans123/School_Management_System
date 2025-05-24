<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Classes\Fee\FeeRepository;
use App\Repository\Classes\Exam\ExamRepository;
use App\Repository\Classes\Quiz\QuizRepository;
use App\Repository\Classes\Admin\AdminRepository;
use App\Repository\Classes\Grade\GradeRepository;
use App\Repository\Classes\Stage\StageRepository;
use App\Repository\Classes\Parent\ParentRepository;
use App\Repository\Classes\Fee\FeeInvoiceRepository;
use App\Repository\Classes\Fee\PaymentFeeRepository;
use App\Repository\Classes\Library\LibraryRepository;
use App\Repository\Classes\Section\SectionRepository;
use App\Repository\Classes\Session\SessionRepository;
use App\Repository\Classes\Setting\SettingRepository;
use App\Repository\Classes\Student\StudentRepository;
use App\Repository\Classes\Subject\SubjectRepository;
use App\Repository\Classes\Teacher\TeacherRepository;
use App\Repository\Classes\Fee\ProcessingFeeRepository;
use App\Repository\Classes\Question\QuestionRepository;
use App\Repository\Classes\Fee\ReceiptStudentRepository;
use App\Repository\Classes\Profile\ProfileRepository;
use App\Repository\Classes\Student\AttendanceRepository;
use App\Repository\Classes\Student\ExamRepository as StudentExamRepository;
use App\Repository\Interfaces\Fee\FeeRepositoryInterface;
use App\Repository\Interfaces\Exam\ExamRepositoryInterface;
use App\Repository\Interfaces\Quiz\QuizRepositoryInterface;
use App\Repository\Classes\Teacher\TeacherSectionRepository;
use App\Repository\Interfaces\Admin\AdminRepositoryInterface;
use App\Repository\Interfaces\Grade\GradeRepositoryInterface;
use App\Repository\Interfaces\Stage\StageRepositoryInterface;
use App\Repository\Classes\Student\GraduatedStudentRepository;
use App\Repository\Classes\Student\StudentPromotionRepository;
use App\Repository\Interfaces\Parent\ParentRepositoryInterface;
use App\Repository\Interfaces\Fee\FeeInvoiceRepositoryInterface;
use App\Repository\Interfaces\Fee\PaymentFeeRepositoryInterface;
use App\Repository\Interfaces\Library\LibraryRepositoryInterface;
use App\Repository\Interfaces\Section\SectionRepositoryInterface;
use App\Repository\Interfaces\Session\SessionRepositoryInterface;
use App\Repository\Interfaces\Setting\SettingRepositoryInterface;
use App\Repository\Interfaces\Student\StudentRepositoryInterface;
use App\Repository\Interfaces\Subject\SubjectRepositoryInterface;
use App\Repository\Interfaces\Teacher\TeacherRepositoryInterface;
use App\Repository\Interfaces\Fee\ProcessingFeeRepositoryInterface;
use App\Repository\Interfaces\Question\QuestionRepositoryInterface;
use App\Repository\Interfaces\Fee\ReceiptStudentRepositoryInterface;
use App\Repository\Interfaces\Student\AttendanceRepositoryInterface;
use App\Repository\Interfaces\Teacher\TeacherSectionRepositoryInterface;
use App\Repository\Interfaces\Student\GraduatedStudentRepositoryInterface;
use App\Repository\Interfaces\Student\StudentPromotionRepositoryInterface;
use App\Repository\Classes\Teacher\Section\SectionRepository as SectionSectionRepository;
use App\Repository\Classes\Teacher\Student\StudentRepository as StudentStudentRepository;
use App\Repository\Interfaces\Profile\ProfileRepositoryInterface;
use App\Repository\Interfaces\Student\ExamRepositoryInterface as StudentExamRepositoryInterface;
use App\Repository\Interfaces\Teacher\Section\SectionRepositoryInterface as SectionSectionRepositoryInterface;
use App\Repository\Interfaces\Teacher\Student\StudentRepositoryInterface as StudentStudentRepositoryInterface;




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(StudentPromotionRepositoryInterface::class, StudentPromotionRepository::class);
        $this->app->bind(TeacherSectionRepositoryInterface::class, TeacherSectionRepository::class);
        $this->app->bind(GraduatedStudentRepositoryInterface::class, GraduatedStudentRepository::class);
        $this->app->bind(FeeRepositoryInterface::class, FeeRepository::class);
        $this->app->bind(FeeInvoiceRepositoryInterface::class, FeeInvoiceRepository::class);
        $this->app->bind(ReceiptStudentRepositoryInterface::class, ReceiptStudentRepository::class);
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);
        $this->app->bind(ParentRepositoryInterface::class, ParentRepository::class);
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(StageRepositoryInterface::class, StageRepository::class);
        $this->app->bind(ProcessingFeeRepositoryInterface::class, ProcessingFeeRepository::class);
        $this->app->bind(PaymentFeeRepositoryInterface::class, PaymentFeeRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(ExamRepositoryInterface::class, ExamRepository::class);
        $this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(SessionRepositoryInterface::class, SessionRepository::class);
        $this->app->bind(LibraryRepositoryInterface::class, LibraryRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(StudentStudentRepositoryInterface::class, StudentStudentRepository::class);
        $this->app->bind(SectionSectionRepositoryInterface::class, SectionSectionRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(StudentExamRepositoryInterface::class, StudentExamRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
