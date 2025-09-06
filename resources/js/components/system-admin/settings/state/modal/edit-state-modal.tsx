import ProcessUpdateStateController from '@/actions/App/Http/Controllers/Web/SystemAdmin/Settings/State/ProcessUpdateStateController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Country } from '@/types/country';
import { State } from '@/types/state';
import { Form } from '@inertiajs/react';
import { X } from 'lucide-react';

type ExtendedState = State & {
    country: {
        id: string;
        name: string;
    };
};

interface EditStateModalProps {
    show: boolean;
    state: ExtendedState;
    countries: Country[];
    onSave: () => void;
    onClose: () => void;
}

export default function EditStateModal({ show, state, countries, onClose, onSave }: EditStateModalProps) {
    if (!show) return null;

    return (
        <div className="bg-opacity-10 fixed inset-0 z-50 flex items-center justify-center" onClick={(e) => e.target === e.currentTarget && onClose()}>
            <div className="relative max-h-[90vh] w-full max-w-md overflow-y-auto rounded-xl bg-white p-6 shadow-lg dark:bg-neutral-900">
                <div className="mb-4 flex items-center justify-between">
                    <h2 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit State</h2>
                    <button onClick={onClose}>
                        <X className="h-4 w-4 text-gray-500" />
                    </button>
                </div>

                <Form
                    {...ProcessUpdateStateController.form({ stateId: state.id })}
                    onSuccess={() => {
                        onSave();
                    }}
                    className="grid grid-cols-1 gap-4 text-sm"
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="country_id">Country</Label>
                                <Select name="country_id" defaultValue={state.country.id}>
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
                                <Label htmlFor="state.name">State Name</Label>
                                <Input id="state.name" name="name" type="text" defaultValue={state.name} className="mt-1 block w-full" />
                                <InputError message={errors.name} className="mt-1" />
                            </div>

                            <div>
                                <Button type="submit" className="mt-2 w-full" disabled={processing}>
                                    Save State
                                </Button>
                            </div>
                        </>
                    )}
                </Form>
            </div>
        </div>
    );
}
