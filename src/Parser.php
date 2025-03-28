<?php

namespace Ssx\Csp;

use GuzzleHttp\Client;

class Parser {
    private array $directives = [];

    public function __construct(string $url)
    {
        try {
            $client = new Client();
            $response = $client->get($url);

            $csps = [];
            foreach ($response->getHeaders() as $header => $value) {
                if (str_contains(strtolower($header), 'content-security-policy')) {
                    $csps[] = $value;
                }
            }

            // Split the CSP headers into their individual rules.
            foreach ($csps as $csp) {
                foreach ($csp as $cspValue) {
                    foreach (explode(';', $cspValue) as $cspParameter) {
                        $rules[] = $cspParameter;
                    }
                }
            }

            // Remove empty rules.
            $rules = array_filter($rules);

            // Types.
            $directives = [];

            // Split out the rules into their types
            foreach ($rules as $rule) {
                $rule = trim($rule);
                if (str_contains($rule, ' ')) {
                    list ($directive, $parameters) = explode(' ', $rule, 2);
                    $params = explode(' ', $parameters);
                    $directives[$directive] = $params;
                } else {
                    $directives[$rule] = [];
                }
            }

            // Stick the directives into the $csps array.
            $this->directives = $directives;
        } catch (\Exception $e) {

        }
    }

    /**
     * @return array
     */
    public function getDirectives()
    {
        return $this->directives;
    }


    /**
     * @return array
     */
    public function getDirective(string $directive = '')
    {
        if (array_key_exists($directive, $this->directives)) {
            return $this->directives[$directive];
        }
        return [];
    }
}