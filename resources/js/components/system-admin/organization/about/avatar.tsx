import { Button } from '@/components/ui/button';
interface Avatar {
    id: string;
    name: string;
}

function generateInitials(name: string): string {
  if (!name) return "?";
  const parts = name.trim().split(" ");
  if (parts.length === 1) {
    return parts[0].charAt(0).toUpperCase();
  }
  return (
    parts[0].charAt(0).toUpperCase() + parts[parts.length - 1].charAt(0).toUpperCase()
  );
}


export default function Avatar({ avatar }: { avatar: Avatar }) {
    return (
        <div className="rounded-lg border p-6 shadow-sm lg:col-span-1">
            <div className="flex justify-center">
                <div className="flex h-24 w-24 items-center justify-center rounded-full bg-neutral-200 text-xl font-semibold text-neutral-700 ring-1 ring-neutral-300 dark:bg-neutral-600 dark:text-neutral-200 dark:ring-neutral-500">
                    {generateInitials(avatar.name)}
                </div>
            </div>
            <div className="mt-6">
                <Button className="w-full">Disable Organization</Button>
            </div>
        </div>
    );
}
