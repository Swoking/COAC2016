#ifndef ADDCLASS_H
#define ADDCLASS_H

#include "ui_addclass.h"

class AddClass : public QDialog, private Ui::AddClass
{
    Q_OBJECT

public:
    explicit AddClass(QWidget *parent = 0);
};

#endif // ADDCLASS_H
