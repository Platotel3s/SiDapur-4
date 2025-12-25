{
    description = "Laravel dev environment";

    inputs = {
        nixpkgs.url = "github:NixOS/nixpkgs/nixos-24.05";
        flake-utils.url = "github:numtide/flake-utils";
    };

    outputs = { self, nixpkgs, flake-utils }:
        flake-utils.lib.eachDefaultSystem (system:
                let
                pkgs = import nixpkgs { inherit system; };
                in {
                devShells.default = pkgs.mkShell {
                packages = with pkgs; [
                php83
                php83Packages.composer
                nodejs_25.2.1
                mysql
                git
                ];

                shellHook = ''
                echo "🚀 Laravel DevShell aktif"
                php -v
                '';
                };
                }
                );
}
