import { Head } from '@inertiajs/react';
import StudentForm from '@/components/student-form';
import { update } from '@/routes/students';

type Student = {
    id: number;
    student_id: string;
    first_name: string;
    middle_name: string | null;
    last_name: string;
    gender: string;
    age: number;
    course: string;
    year_level: number;
    email: string;
    phone: string;
};

type Props = {
    student: Student;
};

export default function StudentsEdit({ student }: Props) {
    return (
        <>
            <Head title="Edit Student" />
            <div className="flex flex-1 flex-col gap-6 p-4 pt-0 md:p-6 md:pt-0">
                <div>
                    <h1 className="text-2xl font-semibold tracking-tight">
                        Edit Student
                    </h1>
                    <p className="text-muted-foreground text-sm">
                        Update {student.first_name} {student.last_name}'s
                        information.
                    </p>
                </div>
                <StudentForm
                    action={update.form(student.id)}
                    student={student}
                    title="Student Information"
                    submitLabel="Update Student"
                />
            </div>
        </>
    );
}
