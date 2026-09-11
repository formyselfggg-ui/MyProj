import { Head, Link } from '@inertiajs/react';
import { ArrowUpRight, GraduationCap, UserRound, Users } from 'lucide-react';
import { Badge } from '@/components/ui/badge';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { dashboard } from '@/routes';
import { index as studentsIndex, show as studentShow } from '@/routes/students';

type Student = {
    id: number;
    student_id: string;
    first_name: string;
    middle_name: string | null;
    last_name: string;
    gender: string;
    course: string;
    year_level: number;
};

type Props = {
    totalStudents: number;
    maleStudents: number;
    femaleStudents: number;
    recentStudents: Student[];
};

function studentName(student: Student): string {
    return [student.first_name, student.middle_name, student.last_name]
        .filter(Boolean)
        .join(' ');
}

export default function Dashboard({
    totalStudents,
    maleStudents,
    femaleStudents,
    recentStudents,
}: Props) {
    const statistics = [
        {
            label: 'Total Students',
            value: totalStudents,
            icon: GraduationCap,
            description: 'All enrolled students',
        },
        {
            label: 'Male Students',
            value: maleStudents,
            icon: UserRound,
            description: 'Students identified as male',
        },
        {
            label: 'Female Students',
            value: femaleStudents,
            icon: Users,
            description: 'Students identified as female',
        },
    ];

    return (
        <>
            <Head title="Dashboard" />
            <div className="flex flex-1 flex-col gap-6 p-4 pt-0 md:p-6 md:pt-0">
                <div className="flex items-center justify-between gap-4">
                    <div>
                        <h1 className="text-2xl font-semibold tracking-tight">
                            Dashboard
                        </h1>
                        <p className="text-muted-foreground text-sm">
                            A quick view of your student records.
                        </p>
                    </div>
                    <Link
                        href={studentsIndex()}
                        className="text-primary inline-flex items-center gap-1 text-sm font-medium"
                    >
                        View all students
                        <ArrowUpRight className="size-4" />
                    </Link>
                </div>

                <div className="grid gap-4 md:grid-cols-3">
                    {statistics.map((statistic) => {
                        const Icon = statistic.icon;

                        return (
                            <Card key={statistic.label}>
                                <CardHeader className="flex-row items-center justify-between space-y-0 pb-2">
                                    <CardTitle className="text-sm font-medium">
                                        {statistic.label}
                                    </CardTitle>
                                    <Icon className="text-muted-foreground size-4" />
                                </CardHeader>
                                <CardContent>
                                    <div className="text-3xl font-bold">
                                        {statistic.value}
                                    </div>
                                    <p className="text-muted-foreground mt-1 text-xs">
                                        {statistic.description}
                                    </p>
                                </CardContent>
                            </Card>
                        );
                    })}
                </div>

                <Card>
                    <CardHeader className="flex-row items-center justify-between">
                        <div>
                            <CardTitle>Recent Students</CardTitle>
                            <CardDescription>
                                The latest records added to the system.
                            </CardDescription>
                        </div>
                        <Badge variant="secondary">
                            {recentStudents.length} records
                        </Badge>
                    </CardHeader>
                    <CardContent>
                        {recentStudents.length === 0 ? (
                            <p className="text-muted-foreground py-8 text-center text-sm">
                                No students found.
                            </p>
                        ) : (
                            <div className="overflow-x-auto">
                                <table className="w-full text-left text-sm">
                                    <thead className="text-muted-foreground border-b text-xs uppercase">
                                        <tr>
                                            <th className="px-3 py-3 font-medium">
                                                Student ID
                                            </th>
                                            <th className="px-3 py-3 font-medium">
                                                Name
                                            </th>
                                            <th className="px-3 py-3 font-medium">
                                                Gender
                                            </th>
                                            <th className="px-3 py-3 font-medium">
                                                Course
                                            </th>
                                            <th className="px-3 py-3 font-medium">
                                                Year
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody className="divide-y">
                                        {recentStudents.map((student) => (
                                            <tr
                                                key={student.id}
                                                className="hover:bg-muted/50"
                                            >
                                                <td className="px-3 py-3 font-medium">
                                                    <Link
                                                        href={studentShow(
                                                            student.id,
                                                        )}
                                                    >
                                                        {student.student_id}
                                                    </Link>
                                                </td>
                                                <td className="px-3 py-3">
                                                    {studentName(student)}
                                                </td>
                                                <td className="px-3 py-3">
                                                    {student.gender}
                                                </td>
                                                <td className="px-3 py-3">
                                                    {student.course}
                                                </td>
                                                <td className="px-3 py-3">
                                                    Year {student.year_level}
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

Dashboard.layout = {
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ],
};
