import { replace } from 'lodash';

export class Formatter {
    public format(target: string): string {
        target = this.opportunity(target);
        target = this.strife(target);
        target = this.ringDie(target);
        target = this.skillDie(target);

        target = this.icon(target);
        target = this.newLine(target);

        return target;
    }

    private opportunity(target: string): string {
        return target.replace(/\\o/g, '{{opportunity}}');
    }

    private strife(target: string): string {
        return target.replace(/\\s/g, '{{strife}}');
    }

    private ringDie(target: string): string {
        return target.replace(/\\rd/g, '{{ring-die}}');
    }

    private skillDie(target: string): string {
        return target.replace(/\\sd/g, '{{skill-die}}');
    }

    private bold(target: string): string {
        return target.replace(/\*\*(.*?)\*\*/g, '<b>$1</b>');
    }

    private icon(target: string): string {
        return target.replace(/{{(.*?)}}/g, '<b><i class="l5r-icon $1"></i></b>');
    }

    private newLine(target: string): string {
        return target.replace(/\\n/g, '<br/>');
    }
}
