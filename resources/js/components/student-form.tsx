import { Form } from '@inertiajs/react';
import type { RouteFormDefinition } from '@/wayfinder';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { index as studentsIndex } from '@/routes/students';

type Student = {
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
    action: RouteFormDefinition<'post'>;
    student?: Student;
    title: string;
    submitLabel: string;
};

const courses = ['BSIT', 'BSCS', 'BSIS', 'BSED', 'BEED', 'BSHM', 'BSBA'];

export default function StudentForm({
    action,
    student,
    title,
    submitLabel,
}: Props) {
    return (
        <Card className="mx-auto w-full max-w-4xl">
            <CardHeader>
                <CardTitle>{title}</CardTitle>
            </CardHeader>
            <CardContent>
                <Form {...action} className="space-y-6">
                    {({ errors, processing }) => (
                        <>
                            <div className="grid gap-6 md:grid-cols-2">
                                <Field
                                    label="Student ID"
                                    name="student_id"
                                    defaultValue={student?.student_id}
                                    error={errors.student_id}
                                    required
                                />
                                <Field
                                    label="First Name"
                                    name="first_name"
                                    defaultValue={student?.first_name}
                                    error={errors.first_name}
                                    required
                                />
                                <Field
                                    label="Middle Name"
                                    name="middle_name"
                                    defaultValue={student?.middle_name ?? ''}
                                    error={errors.middle_name}
                                />
                                <Field
                                    label="Last Name"
                                    name="last_name"
                                    defaultValue={student?.last_name}
                                    error={errors.last_name}
                                    required
                                />
                                <div className="grid gap-2">
                                    <Label htmlFor="gender">Gender</Label>
                                    <select
                                        id="gender"
                                        name="gender"
                                        defaultValue={student?.gender ?? ''}
                                        required
                                        className="border-input bg-background focus-visible:border-ring focus-visible:ring-ring/50 h-9 w-full rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:ring-[3px]"
                                    >
                                        <option value="">Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <InputError message={errors.gender} />
                                </div>
                                <Field
                                    label="Age"
                                    name="age"
                                    type="number"
                                    min={1}
                                    max={100}
                                    defaultValue={student?.age}
                                    error={errors.age}
                                    required
                                />
                                <div className="grid gap-2">
                                    <Label htmlFor="course">Course</Label>
                                    <select
                                        id="course"
                                        name="course"
                                        defaultValue={student?.course ?? ''}
                                        required
                                        className="border-input bg-background focus-visible:border-ring focus-visible:ring-ring/50 h-9 w-full rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:ring-[3px]"
                                    >
                                        <option value="">Select course</option>
                                        {courses.map((course) => (
                                            <option key={course} value={course}>
                                                {course}
                                            </option>
                                        ))}
                                    </select>
                                    <InputError message={errors.course} />
                                </div>
                                <div className="grid gap-2">
                                    <Label htmlFor="year_level">
                                        Year Level
                                    </Label>
                                    <select
                                        id="year_level"
                                        name="year_level"
                                        defaultValue={student?.year_level ?? ''}
                                        required
                                        className="border-input bg-background focus-visible:border-ring focus-visible:ring-ring/50 h-9 w-full rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:ring-[3px]"
                                    >
                                        <option value="">
                                            Select year level
                                        </option>
                                        {[1, 2, 3, 4].map((year) => (
                                            <option key={year} value={year}>
                                                Year {year}
                                            </option>
                                        ))}
                                    </select>
                                    <InputError message={errors.year_level} />
                                </div>
                                <Field
                                    label="Email"
                                    name="email"
                                    type="email"
                                    defaultValue={student?.email}
                                    error={errors.email}
                                    required
                                />
                                <Field
                                    label="Phone"
                                    name="phone"
                                    type="tel"
                                    defaultValue={student?.phone}
                                    error={errors.phone}
                                    required
                                />
                            </div>

                            <div className="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                <Button variant="outline" asChild>
                                    <a href={studentsIndex.url()}>Cancel</a>
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Saving...' : submitLabel}
                                </Button>
                            </div>
                        </>
                    )}
                </Form>
            </CardContent>
        </Card>
    );
}

type FieldProps = {
    label: string;
    name: string;
    type?: string;
    defaultValue?: string | number;
    error?: string;
    required?: boolean;
    min?: number;
    max?: number;
};

function Field({
    label,
    name,
    type = 'text',
    defaultValue,
    error,
    required,
    min,
    max,
}: FieldProps) {
    return (
        <div className="grid gap-2">
            <Label htmlFor={name}>{label}</Label>
            <Input
                id={name}
                name={name}
                type={type}
                defaultValue={defaultValue}
                required={required}
                min={min}
                max={max}
            />
            <InputError message={error} />
        </div>
    );
}
