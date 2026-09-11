import { Head, Link, usePage } from '@inertiajs/react';
import { Plus, Search, Trash2 } from 'lucide-react';
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Badge } from '@/components/ui/badge';
import {
    create,
    destroy,
    edit,
    index as studentsIndex,
    show,
} from '@/routes/students';

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
    students: Student[];
    search: string | null;
};

type SharedProps = {
    flash?: {
        success?: string;
    };
};

function studentName(student: Student): string {
    return [student.first_name, student.middle_name, student.last_name]
        .filter(Boolean)
        .join(' ');
}

export default function StudentsIndex({ students, search }: Props) {
    const { flash } = usePage<SharedProps>().props;
    const [searchValue, setSearchValue] = useState(search ?? '');

    return (
        <>
            <Head title="Students" />

            <div className="flex flex-1 flex-col gap-6 p-4 pt-0 md:p-6 md:pt-0">
                <div className="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                    <div>
                        <h1 className="text-2xl font-semibold tracking-tight">
                            Students
                        </h1>
                        <p className="text-muted-foreground text-sm">
                            Manage student records and enrollment details.
                        </p>
                    </div>
                    <Button asChild>
                        <Link href={create()}>
                            <Plus />
                            Add Student
                        </Link>
                    </Button>
                </div>

                {flash?.success && (
                    <div className="border-primary/30 bg-primary/5 text-primary rounded-md border px-4 py-3 text-sm">
                        {flash.success}
                    </div>
                )}

                <Card>
                    <CardHeader>
                        <CardTitle>Student Directory</CardTitle>
                        <CardDescription>
                            Search by student ID, first name, or last name.
                        </CardDescription>
                        <form
                            action={studentsIndex.url()}
                            method="get"
                            className="flex flex-col gap-2 pt-2 sm:flex-row"
                        >
                            <Input
                                type="search"
                                name="search"
                                value={searchValue}
                                onChange={(event) =>
                                    setSearchValue(event.target.value)
                                }
                                placeholder="Search students..."
                                className="sm:max-w-sm"
                            />
                            <div className="flex gap-2">
                                <Button type="submit">
                                    <Search />
                                    Search
                                </Button>
                                {search && (
                                    <Button variant="outline" asChild>
                                        <Link href={studentsIndex()}>
                                            Clear
                                        </Link>
                                    </Button>
                                )}
                            </div>
                        </form>
                    </CardHeader>
                    <CardContent>
                        {students.length === 0 ? (
                            <div className="text-muted-foreground rounded-md border border-dashed py-12 text-center text-sm">
                                No students found.
                            </div>
                        ) : (
                            <div className="overflow-x-auto rounded-md border">
                                <table className="w-full text-left text-sm">
                                    <thead className="bg-muted/50 text-muted-foreground border-b text-xs uppercase">
                                        <tr>
                                            <th className="px-4 py-3 font-medium">
                                                Student ID
                                            </th>
                                            <th className="px-4 py-3 font-medium">
                                                Name
                                            </th>
                                            <th className="px-4 py-3 font-medium">
                                                Gender
                                            </th>
                                            <th className="px-4 py-3 font-medium">
                                                Age
                                            </th>
                                            <th className="px-4 py-3 font-medium">
                                                Course
                                            </th>
                                            <th className="px-4 py-3 font-medium">
                                                Year
                                            </th>
                                            <th className="px-4 py-3 text-right font-medium">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y">
                                        {students.map((student) => (
                                            <tr
                                                key={student.id}
                                                className="hover:bg-muted/50"
                                            >
                                                <td className="px-4 py-3 font-medium">
                                                    <Link
                                                        className="hover:underline"
                                                        href={show(student.id)}
                                                    >
                                                        {student.student_id}
                                                    </Link>
                                                </td>
                                                <td className="px-4 py-3">
                                                    {studentName(student)}
                                                </td>
                                                <td className="px-4 py-3">
                                                    <Badge variant="outline">
                                                        {student.gender}
                                                    </Badge>
                                                </td>
                                                <td className="px-4 py-3">
                                                    {student.age}
                                                </td>
                                                <td className="px-4 py-3">
                                                    {student.course}
                                                </td>
                                                <td className="px-4 py-3">
                                                    Year {student.year_level}
                                                </td>
                                                <td className="px-4 py-3">
                                                    <div className="flex justify-end gap-2">
                                                        <Button
                                                            variant="outline"
                                                            size="sm"
                                                            asChild
                                                        >
                                                            <Link
                                                                href={edit(
                                                                    student.id,
                                                                )}
                                                            >
                                                                Edit
                                                            </Link>
                                                        </Button>
                                                        <Button
                                                            variant="destructive"
                                                            size="sm"
                                                            asChild
                                                        >
                                                            <Link
                                                                href={destroy(
                                                                    student.id,
                                                                )}
                                                                method="delete"
                                                                as="button"
                                                                onBefore={() =>
                                                                    window.confirm(
                                                                        'Are you sure you want to delete this student?',
                                                                    )
                                                                }
                                                            >
                                                                <Trash2 />
                                                                Delete
                                                            </Link>
                                                        </Button>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </>
    );
}

StudentsIndex.layout = {
    breadcrumbs: [{ title: 'Students', href: studentsIndex() }],
};
