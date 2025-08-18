<?php

namespace App\Enums;

enum CountryCodeEnum: string
{
    case AFGHANISTAN = '+93';
    case ALBANIA = '+355';
    case ALGERIA = '+213';
    case ANDORRA = '+376';
    case ANGOLA = '+244';
    case ARGENTINA = '+54';
    case ARMENIA = '+374';
    case AUSTRALIA = '+61';
    case AUSTRIA = '+43';
    case AZERBAIJAN = '+994';
    case BAHRAIN = '+973';
    case BANGLADESH = '+880';
    case BELARUS = '+375';
    case BELGIUM = '+32';
    case BOLIVIA = '+591';
    case BOSNIA_HERZEGOVINA = '+387';
    case BRAZIL = '+55';
    case BRUNEI = '+673';
    case BULGARIA = '+359';
    case CAMBODIA = '+855';
    case CAMEROON = '+237';
    case CANADA = '+1';
    case CHILE = '+56';
    case CHINA = '+86';
    case COLOMBIA = '+57';
    case CROATIA = '+385';
    case CUBA = '+53';
    case CYPRUS = '+357';
    case CZECH_REPUBLIC = '+420';
    case DENMARK = '+45';
    case ECUADOR = '+593';
    case EGYPT = '+20';
    case ESTONIA = '+372';
    case ETHIOPIA = '+251';
    case FINLAND = '+358';
    case FRANCE = '+33';
    case GEORGIA = '+995';
    case GERMANY = '+49';
    case GHANA = '+233';
    case GREECE = '+30';
    case HUNGARY = '+36';
    case ICELAND = '+354';
    case INDIA = '+91';
    case INDONESIA = '+62';
    case IRAN = '+98';
    case IRAQ = '+964';
    case IRELAND = '+353';
    case ISRAEL = '+972';
    case ITALY = '+39';
    case JAPAN = '+81';
    case JORDAN = '+962';
    case KAZAKHSTAN = '+7';
    case KENYA = '+254';
    case KUWAIT = '+965';
    case LATVIA = '+371';
    case LEBANON = '+961';
    case LIBYA = '+218';
    case LITHUANIA = '+370';
    case LUXEMBOURG = '+352';
    case MALAYSIA = '+60';
    case MEXICO = '+52';
    case MOROCCO = '+212';
    case NETHERLANDS = '+31';
    case NEW_ZEALAND = '+64';
    case NIGERIA = '+234';
    case NORWAY = '+47';
    case PAKISTAN = '+92';
    case PALESTINE = '+970';
    case PERU = '+51';
    case PHILIPPINES = '+63';
    case POLAND = '+48';
    case PORTUGAL = '+351';
    case QATAR = '+974';
    case ROMANIA = '+40';
    case RUSSIA = '+7';
    case SAUDI_ARABIA = '+966';
    case SINGAPORE = '+65';
    case SLOVAKIA = '+421';
    case SLOVENIA = '+386';
    case SOUTH_AFRICA = '+27';
    case SOUTH_KOREA = '+82';
    case SPAIN = '+34';
    case SRI_LANKA = '+94';
    case SWEDEN = '+46';
    case SWITZERLAND = '+41';
    case SYRIA = '+963';
    case TAIWAN = '+886';
    case THAILAND = '+66';
    case TURKEY = '+90';
    case UKRAINE = '+380';
    case UAE = '+971';
    case UNITED_KINGDOM = '+44';
    case UNITED_STATES = '+1';
    case URUGUAY = '+598';
    case VENEZUELA = '+58';
    case VIETNAM = '+84';
    case YEMEN = '+967';

    public static function getCountryCode(string $countryName): ?string
    {
        // Convert country name to enum case format
        $enumCase = strtoupper(str_replace([' ', '-'], '_', $countryName));
        
        // Try to get the enum case
        $cases = self::cases();
        foreach ($cases as $case) {
            if ($case->name === $enumCase) {
                return $case->value;
            }
        }
        
        return null;
    }

    public static function getAllCountryCodes(): array
    {
        $codes = [];
        foreach (self::cases() as $case) {
            $codes[$case->name] = $case->value;
        }
        return $codes;
    }
}