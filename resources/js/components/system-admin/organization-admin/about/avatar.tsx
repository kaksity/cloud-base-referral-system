import { Button } from '@/components/ui/button';
import { useInitials } from '@/hooks/use-initials';
interface Avatar {
    id: string;
    first_name: string;
    middle_name: string;
    last_name: string;
}

export default function Avatar({ avatar }: { avatar: Avatar }) {
    const generateInitials = useInitials();
    return (
        <div className="rounded-lg border p-6 shadow-sm lg:col-span-1">
            <div className="flex justify-center">
                <div className="flex h-24 w-24 items-center justify-center rounded-full bg-neutral-200 text-xl font-semibold text-neutral-700 ring-1 ring-neutral-300 dark:bg-neutral-600 dark:text-neutral-200 dark:ring-neutral-500">
                    {generateInitials(avatar.first_name, avatar.last_name)}
                </div>
            </div>
            <div className="mt-6">
                <Button className="w-full">Disable Organization Admin</Button>
            </div>
        </div>
    );
}
