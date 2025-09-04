import { Link } from '@inertiajs/react';

export default function NoRecordsFound({
    title,
    description,
    href,
    linkLabel,
}: {
    title: string;
    description: string;
    href?: string;
    linkLabel?: string;
}) {
    return (
        <div className="flex h-full min-h-[400px] flex-col items-center justify-center rounded-md border border-gray-200 bg-white px-6 py-10 text-center text-gray-600 shadow-sm dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-100">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                className="mb-4 h-12 w-12 text-gray-400 dark:text-neutral-500"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0a2 2 0 100 4 2 2 0 100-4zm6 0a2 2 0 100 4 2 2 0 100-4zM12 3v4m0 0L8 5m4 2l4-2"
                />
            </svg>

            <h2 className="mb-1 text-lg font-semibold">{title}</h2>
            <p className="mb-4">{description}</p>
            <Link
                href={href}
                className="inline-flex h-9 w-full shrink-0 items-center justify-center gap-2 rounded-md bg-primary px-4 py-2 text-sm font-medium whitespace-nowrap text-primary-foreground shadow-xs transition-all outline-none hover:bg-primary/90 focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 has-[>svg]:px-3 aria-invalid:border-destructive aria-invalid:ring-destructive/20 md:w-auto dark:aria-invalid:ring-destructive/40 [&_svg]:pointer-events-none [&_svg]:shrink-0 [&_svg:not([class*='size-'])]:size-4"
            >
                {linkLabel}
            </Link>
        </div>
    );
}
