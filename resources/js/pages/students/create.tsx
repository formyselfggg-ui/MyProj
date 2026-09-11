import { Head } from '@inertiajs/react';
import StudentForm from '@/components/student-form';
import { store } from '@/routes/students';

export default function StudentsCreate() {
    return (
        <>
            <Head title="Add Student" />
            <div className="flex flex-1 flex-col gap-6 p-4 pt-0 md:p-6 md:pt-0">
                <div>
                    <h1 className="text-2xl font-semibold tracking-tight">
                        Add Student
                    </h1>
                    <p className="text-muted-foreground text-sm">
                        Add a new student to the directory.
                    </p>
                </div>
                <StudentForm
                    action={store.form()}
                    title="Student Information"
                    submitLabel="Save Student"
                />
            </div>
        </>
    );
}
