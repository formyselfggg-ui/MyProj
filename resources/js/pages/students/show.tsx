import { Head, Link } from '@inertiajs/react';
import { ArrowLeft, Pencil } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { edit, index as studentsIndex } from '@/routes/students';

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

function studentName(student: Student): string {
    return [student.first_name, student.middle_name, student.last_name]
        .filter(Boolean)
        .join(' ');
}

export default function StudentsShow({ student }: Props) {
    const details = [
        ['Student ID', student.student_id],
        ['Full Name', studentName(student)],
        ['Gender', student.gender],
        ['Age', student.age],
        ['Course', student.course],
        ['Year Level', `Year ${student.year_level}`],
        ['Email', student.email],
        ['Phone', student.phone],
    ];

    return (
        <>
            <Head title="View Student" />
            <div className="flex flex-1 flex-col gap-6 p-4 pt-0 md:p-6 md:pt-0">
                <div className="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                    <div>
                        <h1 className="text-2xl font-semibold tracking-tight">
                            Student Details
                        </h1>
                        <p className="text-muted-foreground text-sm">
                            View the complete student record.
                        </p>
                    </div>
                    <div className="flex gap-2">
                        <Button variant="outline" asChild>
                            <Link href={studentsIndex()}>
                                <ArrowLeft />
                                Back
                            </Link>
                        </Button>
                        <Button asChild>
                            <Link href={edit(student.id)}>
                                <Pencil />
                                Edit
                            </Link>
                        </Button>
                    </div>
                </div>

                <Card className="max-w-3xl">
                    <CardHeader>
                        <CardTitle>{studentName(student)}</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <dl className="grid gap-5 sm:grid-cols-2">
                            {details.map(([label, value]) => (
                                <div key={label} className="grid gap-1">
                                    <dt className="text-muted-foreground text-sm">
                                        {label}
                                    </dt>
                                    <dd className="font-medium">
                                        {label === 'Gender' ? (
                                            <Badge variant="outline">
                                                {value}
                                            </Badge>
                                        ) : (
                                            value
                                        )}
                                    </dd>
                                </div>
                            ))}
                        </dl>
                    </CardContent>
                </Card>
            </div>
        </>
    );
}
