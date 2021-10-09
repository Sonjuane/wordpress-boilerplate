<?php
/**
 * Copyright (C) 2014-2020 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Kangaroos cannot jump here' );
}

class Ai1wmse_Error_Exception extends Exception {}
class Ai1wmse_Connect_Exception extends Ai1wmse_Error_Exception {}
class Ai1wmse_Rate_Limit_Exception extends Ai1wmse_Connect_Exception {}
class Ai1wmse_Request_Timeout_Exception extends Ai1wmse_Connect_Exception {}
class Ai1wmse_Internal_Server_Error_Exception extends Ai1wmse_Connect_Exception {}
class Ai1wmse_Authorization_Header_Malformed_Exception extends Ai1wmse_Error_Exception {}
class Ai1wmse_Invalid_Access_Key_Id_Exception extends Ai1wmse_Error_Exception {}
class Ai1wmse_Invalid_Bucket_Name_Exception extends Ai1wmse_Error_Exception {}
class Ai1wmse_Signature_Does_Not_Match_Exception extends Ai1wmse_Error_Exception {}
class Ai1wmse_Access_Denied_Exception extends Ai1wmse_Error_Exception {}
class Ai1wmse_All_Access_Disabled_Exception extends Ai1wmse_Error_Exception {}
class Ai1wmse_No_Such_Bucket_Exception extends Ai1wmse_Error_Exception {}
