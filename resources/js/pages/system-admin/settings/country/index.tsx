import CreateCountryModal from '@/components/system-admin/settings/country/modal/create-country-modal';
import EditCountryModal from '@/components/system-admin/settings/country/modal/edit-country-modal';
import CountryTable from '@/components/system-admin/settings/country/country-table';
import { Button } from '@/components/ui/button';
import SettingsLayout from '@/layouts/settings-layout';
import { displayProfileView } from '@/routes/web/system-admin/settings/profile';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useState } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Profile settings',
        href: displayProfileView().url,
    },
];

interface Country {
    id: string;
    name: string;
}

interface PaginationMeta {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
}

interface PaginationLinks {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
}

export default function ViewCountries({
    countries,
    paginationPayload,
}: {
    countries: Country[];
    paginationPayload: {
        meta: PaginationMeta;
        links: PaginationLinks;
    };
}) {
    const [showCreateCountryModal, setShowCreateCountryModal] = useState(false);
    const [showEditCountryModal, setShowEditCountryModal] = useState(false);
    const [selectedCountry, setSelectedCountry] = useState<Country | null>(null);

    function handleEditCountryClicked(country: Country) {
        setSelectedCountry(country);
        setShowEditCountryModal(true);
    }

    return (
        <SettingsLayout breadcrumbs={breadcrumbs}>
            <Head title="Country" />

            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="flex items-center justify-between px-2 py-5">
                    <div>
                        <h1 className="text-xl font-semibold">Country</h1>
                        <p className="text-gray-600">Manage your manage your countries here.</p>
                    </div>

                    <div className="flex gap-2">
                        <Button onClick={() => setShowCreateCountryModal(true)}>Add Country</Button>
                    </div>
                </div>

                <div className="rounded-md">
                    <CountryTable countries={countries} paginationPayload={paginationPayload} onEditCountryClicked={handleEditCountryClicked} />
                </div>
            </div>
            <CreateCountryModal
                show={showCreateCountryModal}
                onClose={() => setShowCreateCountryModal(false)}
                onSave={() => setShowCreateCountryModal(false)}
            />
            {selectedCountry && (
                <EditCountryModal
                    show={showEditCountryModal}
                    country={selectedCountry}
                    onClose={() => setShowEditCountryModal(false)}
                    onSave={() => setShowEditCountryModal(false)}
                />
            )}
        </SettingsLayout>
    );
}
