import ProcessCreateWardController from '@/actions/App/Http/Controllers/Web/SystemAdmin/Settings/Ward/ProcessCreateWardController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { displayWardsView } from '@/routes/web/system-admin/settings/ward';
import { Country } from '@/types/country';
import { LocalGovernmentArea } from '@/types/local-government-area';
import { State } from '@/types/state';
import { Form, router } from '@inertiajs/react';
import { X } from 'lucide-react';

interface CreateWardModalProps {
    show: boolean;
    countries: Country[];
    localGovernmentAreas: LocalGovernmentArea[];
    states: State[];
    onSave: () => void;
    onClose: () => void;
}

function handleCountryChanged(countryId: string) {
    router.visit(displayWardsView(), {
        preserveState: true,
        data: {
            country_id: countryId,
        },
        replace: true,
        only: ['states'],
    });
}

function handleStateChanged(stateId: string) {
    router.visit(displayWardsView(), {
        preserveState: true,
        data: {
            state_id: stateId,
        },
        replace: true,
        only: ['localGovernmentAreas'],
    });
}

export default function CreateWardModal({ show, onClose, onSave, countries, states, localGovernmentAreas }: CreateWardModalProps) {
    if (!show) return null;

    return (
        <div className="bg-opacity-10 fixed inset-0 z-50 flex items-center justify-center" onClick={(e) => e.target === e.currentTarget && onClose()}>
            <div className="relative max-h-[90vh] w-full max-w-md overflow-y-auto rounded-xl bg-white p-6 shadow-lg dark:bg-neutral-900">
                <div className="mb-4 flex items-center justify-between">
                    <h2 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Create Ward</h2>
                    <button onClick={onClose}>
                        <X className="h-4 w-4 text-gray-500" />
                    </button>
                </div>

                <Form {...ProcessCreateWardController.form()} className="grid grid-cols-1 gap-4 text-sm" onSuccess={() => onSave()}>
                    {({ processing, errors }) => (
                        <>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="country_id">Country</Label>
                                <Select name="country_id" onValueChange={handleCountryChanged}>
                                    <SelectTrigger id="country_id">
                                        <SelectValue placeholder="-- Select Country --" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {countries.map((country) => (
                                            <SelectItem key={country.id} value={String(country.id)}>
                                                {country.name}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <InputError message={errors.country_id} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="state_id">State</Label>
                                <Select name="state_id" onValueChange={handleStateChanged}>
                                    <SelectTrigger id="state_id">
                                        <SelectValue placeholder="-- Select State --" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {states.map((state) => (
                                            <SelectItem key={state.id} value={String(state.id)}>
                                                {state.name}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <InputError message={errors.state_id} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="local_government_area_id">Local Government Area</Label>
                                <Select name="local_government_area_id">
                                    <SelectTrigger id="local_government_area_id">
                                        <SelectValue placeholder="-- Select Ward --" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {localGovernmentAreas.map((localGovernmentArea) => (
                                            <SelectItem key={localGovernmentArea.id} value={String(localGovernmentArea.id)}>
                                                {localGovernmentArea.name}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <InputError message={errors.local_government_area_id} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="name">Ward Name</Label>
                                <Input id="name" name="name" placeholder="e.g. Lagos, Kano" />
                                <InputError message={errors.name} />
                            </div>

                            <div>
                                <Button type="submit" className="mt-2 w-full" disabled={processing}>
                                    Save Ward
                                </Button>
                            </div>
                        </>
                    )}
                </Form>
            </div>
        </div>
    );
}
