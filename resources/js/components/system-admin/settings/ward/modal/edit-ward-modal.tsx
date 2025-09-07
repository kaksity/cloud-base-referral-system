import ProcessUpdateWardController from '@/actions/App/Http/Controllers/Web/SystemAdmin/Settings/Ward/ProcessUpdateWardController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { displayLocalGovernmentAreasView } from '@/routes/web/system-admin/settings/local-government-area';
import { displayWardsView } from '@/routes/web/system-admin/settings/ward';
import { Country } from '@/types/country';
import { LocalGovernmentArea } from '@/types/local-government-area';
import { State } from '@/types/state';
import { ExtendWard } from '@/types/ward';
import { Form, router } from '@inertiajs/react';
import { X } from 'lucide-react';

interface EditLocalGovernmentAreaModalProps {
    show: boolean;
    ward: ExtendWard;
    localGovernmentAreas: LocalGovernmentArea[];
    countries: Country[];
    states: State[];
    onSave: () => void;
    onClose: () => void;
}

function handleCountryChanged(countryId: string) {
    router.visit(displayLocalGovernmentAreasView(), {
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

export default function EditLocalGovernmentAreaModal({
    show,
    states,
    ward,
    countries,
    onClose,
    localGovernmentAreas,
    onSave,
}: EditLocalGovernmentAreaModalProps) {
    if (!show) return null;

    return (
        <div className="bg-opacity-10 fixed inset-0 z-50 flex items-center justify-center" onClick={(e) => e.target === e.currentTarget && onClose()}>
            <div className="relative max-h-[90vh] w-full max-w-md overflow-y-auto rounded-xl bg-white p-6 shadow-lg dark:bg-neutral-900">
                <div className="mb-4 flex items-center justify-between">
                    <h2 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Ward</h2>
                    <button onClick={onClose}>
                        <X className="h-4 w-4 text-gray-500" />
                    </button>
                </div>

                <Form
                    {...ProcessUpdateWardController.form({ wardId: ward.id })}
                    onSuccess={() => {
                        onSave();
                    }}
                    className="grid grid-cols-1 gap-4 text-sm"
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="country_id">Country</Label>
                                <Select name="country_id" defaultValue={ward.country.id} onValueChange={handleCountryChanged}>
                                    <SelectTrigger id="country_id">
                                        <SelectValue placeholder="-- Select Country --" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {countries.map((country) => (
                                            <SelectItem key={country.id} value={country.id}>
                                                {country.name}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <InputError message={errors.country_id} />
                            </div>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="state_id">State</Label>
                                <Select name="state_id" defaultValue={ward.state.id} onValueChange={handleStateChanged}>
                                    <SelectTrigger id="state_id">
                                        <SelectValue placeholder="-- Select State --" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {states.map((state) => (
                                            <SelectItem key={state.id} value={state.id}>
                                                {state.name}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <InputError message={errors.state_id} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="local_government_area_id">Local Government Area</Label>
                                <Select name="local_government_area_id" defaultValue={ward.local_government_area.id}>
                                    <SelectTrigger id="local_government_area_id">
                                        <SelectValue placeholder="-- Select State --" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        {localGovernmentAreas.map((localGovernmentArea) => (
                                            <SelectItem key={localGovernmentArea.id} value={localGovernmentArea.id}>
                                                {localGovernmentArea.name}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <InputError message={errors.local_government_area_id} />
                            </div>

                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="ward.name">Ward Name</Label>
                                <Input id="ward.name" name="name" type="text" defaultValue={ward.name} className="mt-1 block w-full" />
                                <InputError message={errors.name} className="mt-1" />
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
