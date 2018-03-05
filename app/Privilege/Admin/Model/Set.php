<?php

namespace Privilege\Admin\Model;

use core\Model;

class Set extends Model
{
    const QUOTE = '"';

    public function getCommandString()
    {
        $id = !empty($_POST['server']) ? $_POST['server'] : null;
        if (!$id) {
            return 'Server id not found';
        }

        /** Set empty arguments for string */
        for ($i = 0; $i <= 18; ++$i) {
            $command[$i] = self::QUOTE . self::QUOTE;
        }

        /** Get privileges for current game server */
        $select = $this->getDb()->select();
        $select->from('server_privileges')->where('server_id = ?', $id);
        $privileges = $select->fetchAll();

        foreach ($privileges as $privilege) {
            $id         = $privilege['entity_id'];
            $argument   = $privilege['argument'];
            $flags      = $privilege['flags'];

            if (!empty($_POST[$id])) {
                $command[$argument] = self::QUOTE . $flags . self::QUOTE;
                $command[$argument + 1] = self::QUOTE . $_POST['day_' . $id] . self::QUOTE;
            }
        }

        $command[0] = 'amx_adduser_privileges';
        $command[1] = self::QUOTE . $_POST['value'] . self::QUOTE;
        $command[2] = self::QUOTE . $_POST['password'] . self::QUOTE;
        $command[4] = self::QUOTE . $_POST['type'] . self::QUOTE;
        $command[17] = self::QUOTE . $_POST['contact'] . self::QUOTE;
        $command[18] = self::QUOTE . $_POST['active'] . self::QUOTE;

        ksort($command);

        return implode(' ', $command);
    }

    public function getServer($id)
    {
        $select = $this->getDb()->select();
        $select->from('server_entity')->where('entity_id = ?', $id);
        $data = $select->fetch();
        return !empty($data['name']) ? $data['name'] : null;
    }
}