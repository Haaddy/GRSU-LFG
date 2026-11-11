export interface EventItem {
    id: number;
    name: string;
    description: string;
    date: string;
    organizer: string;
    participants: number;
    teamRequired: boolean;
    status: 'Upcoming' | 'Ongoing' | 'Completed';
}
