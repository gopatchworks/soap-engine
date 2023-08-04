<?php

declare(strict_types=1);

namespace Soap\Engine\Metadata\Model;

use Soap\Engine\Metadata\Collection\ParameterCollection;
use Soap\WsdlReader\Model\Definitions\QNamed;

final class Method
{
    private ParameterCollection $parameters;
    private ParameterCollection $headers;
    private string $name;
    private XsdType $returnType;
    private MethodMeta $meta;
    private ?QNamed $namespace;

    public function __construct(
        string $name,
        ParameterCollection $parameters,
        XsdType $returnType,
        ParameterCollection $headers,
        QNamed $namespace = null
    ) {
        $this->name = $name;
        $this->returnType = $returnType;
        $this->headers = $headers;
        $this->parameters = $parameters;
        $this->meta = new MethodMeta();
        $this->namespace = $namespace;
    }

    public function getParameters(): ParameterCollection
    {
        return $this->parameters;
    }

    public function getHeaders(): ParameterCollection
    {
        return $this->headers;
    }

    public function getNamespace(): ?QNamed
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReturnType(): XsdType
    {
        return $this->returnType;
    }

    public function getMeta(): MethodMeta
    {
        return $this->meta;
    }

    /**
     * @param callable(MethodMeta): MethodMeta $metaProvider
     */
    public function withMeta(callable $metaProvider): self
    {
        $new = clone $this;
        $new->meta = $metaProvider($this->meta);

        return $new;
    }
}
