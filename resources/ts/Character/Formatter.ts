import { replace } from 'lodash';

export class Formatter {
    public format(target: string): string {
        target = this.bold(target);
        target = this.icon(target);

        return target;
    }

    private bold(target: string): string {
        return target.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
    }

    private icon(target: string): string {
        return target.replace(/{{(.*?)}}/g, '<b><i class="l5r-icon $1"></i></b>');
    }
}
