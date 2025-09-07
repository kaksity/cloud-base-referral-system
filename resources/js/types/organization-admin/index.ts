export interface OrganizationAdmin {
    id: string;
    organization: {
        id: string;
        name: string;
    };
    added_by_system_admin: {
        first_name: string;
        last_name: string;
    };
    first_name: string;
    middle_name: string;
    last_name: string;
    mobile_number: string;
    email: string;
}
