<?php

$data = [
    'ring-die' => 6,
    'skill-die' => 2,
    'success' => 'S',
    'explosive-success' => 'E',
    'opportunity' => 'O',
    'strife' => 's',
    'dragon' => 'F',
    'lion' => 'G',
    'mantis' => 'H',
    'phoenix' => 'I',
    'scorpion' => 'J',
    'tortoise' => 'I',
    'unicorn' => 'L',
    'crab' => 'M',
    'crane' => 'N',
    'imperial' => 'P',
    'unknown-1' => '0',
    'fan' => 1,
    'unknown-2' => 'Z',
    'rituals' => 'h',
    'ninjutsu' => 'i',
    'shuji' => 'j',
    'kata' => 'k',
    'invocations' => 'l',
    'kiho' => 'm',
    'maho' => 'n',
    'unknown-3' => 'p',
    'unknown-4' => 'o',
    'unknown-5' => 'q',
    'earth' => 'e',
    'void' => 'v',
    'water' => 'w',
    'air' => 'a',
    'fire' => 'f',
    'air-2' => 'à',
    'earth-2' => 'á',
    'fire-2' => 'â',
    'void-2' => 'ã',
    'water-2' => 'ä'
];

$colours = [
    'earth' => '698e6d',
    'air' => '866f89',
    'water' => '5c838a',
    'fire' => '8e6a46',
    'void' => '463e3c',
];

$output = "@font-face {
    font-family: \"l5r\";
    src: url(\"@/fonts/l5r-icons.ttf\") format(\"truetype\");
    font-style: normal;
    font-weight: normal;
}

.l5r-icon {
    font: normal normal normal 14px/1 l5r;
    display: inline-block;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;

    &.icon-lg {
        font-size: 1.33333333em;
        line-height: 0.75em;
        vertical-align: -15%;
    }

    &.icon-2x {
        font-size: 2em;
    }

    &.icon-3x {
        font-size: 3em;
    }

    &.icon-4x {
        font-size: 4em;
    }

    &.icon-5x {
        font-size: 5em;
    }

    &.icon-fw {
        width: 1.28571429em;
        text-align: center;
    }

    &.icon-ul {
        padding-left: 0;
        margin-left: 2.14285714em;
        list-style-type: none;
    }\n";

foreach ($data as $class => $value) {
    $output .= "\n    &.{$class}:before {
        content: \"{$value}\";
    }\n";
}

$output .= '}';

foreach ($colours as $colour => $hex) {
    $output .= "\n    .color-{$colour} {
        color: #{$hex};
    }\n";
}
foreach ($colours as $colour => $hex) {
    $output .= "\n    .background-{$colour} {
        background: #{$hex};
    }\n";
}

file_put_contents(__DIR__ . '/l5r.scss', $output);
