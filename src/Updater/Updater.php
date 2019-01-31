<?php

namespace Thunderbird\Updater;

class Updater
{
    public function updateThunderbird($version)
    {
        // Download latest release from GitHub
        shell_exec("git clone -b " . $version . " --single-branch https://github.com/ThunderbirdSSG/Thunderbird.git local/updater/download");

        // Change into the release directory and remove the Git folder
        shell_exec("cd local/updater/download && rm -rf .git");

        // Copy across the src directory
        shell_exec("cp -a local/updater/download/src/* src");

        // Copy across the thunderbird console file
        shell_exec("cp local/updater/download/thunderbird ./");

        // Delete the downloaded release
        shell_exec("rm -rf local/updater/download");
    }
}